<?php

namespace App\Filament\Imports;

use App\Models\Politician;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PoliticianImporter extends Importer
{
    protected static ?string $model = Politician::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make("name")
                ->requiredMapping(),
            ImportColumn::make("email")
                ->requiredMapping(),
            ImportColumn::make("canton")
                ->relationship(resolveUsing: "name")
                ->requiredMapping(),
            ImportColumn::make("faction")
                ->relationship(resolveUsing: "name")
                ->requiredMapping(),
            ImportColumn::make("council")
                ->relationship(resolveUsing: "name")
                ->requiredMapping(),
        ];
    }

    public function resolveRecord(): ?Politician
    {
        // return Politician::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Politician();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your politician import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
