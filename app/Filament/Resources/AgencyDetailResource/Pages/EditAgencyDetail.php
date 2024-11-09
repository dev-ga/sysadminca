<?php

namespace App\Filament\Resources\AgencyDetailResource\Pages;

use App\Filament\Resources\AgencyDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgencyDetail extends EditRecord
{
    protected static string $resource = AgencyDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
