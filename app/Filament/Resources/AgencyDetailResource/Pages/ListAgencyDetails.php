<?php

namespace App\Filament\Resources\AgencyDetailResource\Pages;

use App\Filament\Resources\AgencyDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgencyDetails extends ListRecords
{
    protected static string $resource = AgencyDetailResource::class;

    protected ?string $heading = 'Detalles de Agencias';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
