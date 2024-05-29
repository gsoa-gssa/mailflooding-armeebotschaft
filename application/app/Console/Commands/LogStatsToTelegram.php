<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Models\Contact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogStatsToTelegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log stats to Telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stats = [
            "sent_emails" => Email::whereNot("sent_at", null)->count(),
            "sent_within_30_minutes" => Email::where("sent_at", ">", now()->subMinutes(30))->count(),
            "number_of_contacts" => Contact::count(),
        ];
        $time = now();
        $message = <<<EOD
Stats update for $time -------
Sent emails: {$stats["sent_emails"]} -------
Sent within 30 minutes: {$stats["sent_within_30_minutes"]} -------
Number of contacts: {$stats["number_of_contacts"]}
EOD;
        Log::channel('telegram')->info($message);
    }
}
