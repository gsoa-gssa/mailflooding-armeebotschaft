<?php

namespace App\Console\Commands;

use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Console\Command;
use SendGrid\Mail\Mail;

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
        $emails = Email::whereNull('sent_at')->whereNot("body", null)->whereNot("subject", null)->limit(10)->get();
        $sdg = new \SendGrid(env('SDG_API_KEY'));
        $startDate = Carbon::parse("2024-05-30 08:00:00");
        foreach ($emails as $email) {
            $contact = $email->contact;
            app()->setLocale($contact->locale);
            $from = str_replace(" ", "", strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $contact->firstname . "." . $contact->lastname . __("@unsinnig.ch"))));
            $mail = new Mail();
            $mail->setFrom($from, $contact->firstname . " " . $contact->lastname);
            if (now() < $startDate) {
                $to = "timothy@gsoa.ch";
            } else {
                $to = $email->politician->email;
            }
            $mail->addTo($to, $email->politician->name);
            $mail->setSubject($email->subject);
            $mail->addContent("text/html", $email->body);
            try {
                $response = $sdg->send($mail);
                echo $response->statusCode() . "\n";
                if ($response->statusCode() == 202) {
                    $email->sent_at = now();
                    $email->save();
                }
            } catch (\Exception $e) {
                $response = $e->getMessage();
            }
        }
    }
}
