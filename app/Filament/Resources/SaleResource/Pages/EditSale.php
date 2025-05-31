<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

    protected ?string $heading = 'Detalles de Venta';

    
    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }

    protected function getFormActions(): array
    {
        return [
            // ...parent::getFormActions(),
            // Action::make('close')->action('saveAndClose'),
        ];
    }
}