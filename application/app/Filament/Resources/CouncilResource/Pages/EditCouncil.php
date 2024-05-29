<?php

namespace App\Filament\Resources\CouncilResource\Pages;

use App\Filament\Resources\CouncilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCouncil extends EditRecord
{
    protected static string $resource = CouncilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
