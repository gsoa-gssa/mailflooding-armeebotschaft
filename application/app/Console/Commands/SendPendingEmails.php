<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Email;
use SendGrid\Mail\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPendingEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails = Email::whereNull('sent_at')->whereNot("body", null)->whereNot("subject", null)->limit(25)->get();
        $sdg = new \SendGrid(env('SDG_API_KEY'));
        $startDate = Carbon::parse("2024-05-30 08:00:00");
        foreach ($emails as $email) {
            $contact = $email->contact;
            app()->setLocale($contact->locale);
            // Replace umlauts and special characters with ASCII characters
            $from = strtolower(str_replace(
                ["ä", "ö", "ü", "ß", " ", "ç", "é", "è", "à", "-", "."],
                ["ae", "oe", "ue", "ss", "", "c", "e", "e", "a", "", ""],
                $contact->firstname . "." . $contact->lastname . "@unsinnig.ch"
                )
            );
            $mail = new Mail();
            try {
                $mail->setFrom($from, $contact->firstname . " " . $contact->lastname);
                if (now() < $startDate) {
                    $to = "timothy@gsoa.ch";
                } else {
                    $to = $email->politician->email;
                }
                $mail->addTo($to, $email->politician->name);
                $mail->setSubject($email->subject);
                $mail->setReplyTo(env('REPLY_TO_EMAIL'));
                $mail->addContent("text/html", $email->body);
                $response = $sdg->send($mail);
                Log::channel("email")->info("Email sent to " . $email->politician->name . " (" . $email->politician->email . "). Response with status code " . $response->statusCode());
                if ($response->statusCode() == 202) {
                    $email->sent_at = now();
                    $email->save();
                }
            } catch (\Exception $e) {
                $response = $e->getMessage();
                Log::channel("telegram")->error("Email could not be sent to " . $email->politician->name . " (" . $email->politician->email . "), E-Mail ID: " . $email->id . ". From E-Mail: " . $from . ". Error: " . $response);
                Log::channel("email")->error("Email could not be sent to " . $email->politician->name . " (" . $email->politician->email . "). E-Mail ID: " . $email->id . ". From E-Mail: " . $from . ". Error: " . $response);
            }
        }
    }
}
