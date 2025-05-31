<?php

namespace App\Filament\Resources\SaleResource\Widgets;

use App\Models\Sale;
use App\Models\TasaBcv;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Filament\Resources\SaleResource\Pages\ListSales;

class SalesTypeOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListSales::class;
    }
    
    protected function getStats(): array
    {
        $data = Trend::model(Sale::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth();
        // ->count('cliente');


        return [

            Stat::make('ON-LINE', '$'.$this->getPageTableQuery()->where('type_sale', 'on-line')->sum('total_sale'))
                ->description('Neto de ventas en dolares')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('PISO DE VENTA', '$'.$this->getPageTableQuery()->where('type_sale', 'tienda-fisica')->sum('total_sale'))
                ->description('Neto de ventas en dolares')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
        ];
    }

    public function getColumns(): int
    {
        return 2;
    }
}