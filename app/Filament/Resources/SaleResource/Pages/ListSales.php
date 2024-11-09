<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListSales extends ListRecords
{
    use ExposesTableToWidgets;
    
    protected ?string $heading = 'Dashboard de Ventas';

    protected static string $resource = SaleResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            SaleResource\Widgets\SalesOverview::class,
            SaleResource\Widgets\SalesTypeOverview::class,
            SaleResource\Widgets\SalesCommissionOverview::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
