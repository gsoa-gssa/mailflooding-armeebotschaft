<?php

namespace App\Filament\Widgets;

use App\Models\Email;
use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class EmailStats extends BaseWidget
{
    protected function getStats(): array
    {
        $sentEmails = Email::whereNot('sent_at', null)->count();
        $sentEmailsWithin30Minutes = Email::where('sent_at', '>', now()->subMinutes(30))->count();
        $pendingEmails = Email::where('sent_at', null)->count();
        $contacts = Contact::count();
        $optinContacts = Contact::where('optin', true)->count();
        return [
            Stat::make('Sent Emails', $sentEmails),
            Stat::make('Pending Emails', $pendingEmails),
            Stat::make('Sent Emails within 30 minutes', $sentEmailsWithin30Minutes),
            Stat::make('Contacts', $contacts),
            Stat::make('Opt-in Contacts', $optinContacts),
        ];
    }
}
