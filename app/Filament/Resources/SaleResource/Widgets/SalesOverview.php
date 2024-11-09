<?php

namespace App\Filament\Resources\SaleResource\Widgets;

use App\Filament\Resources\SaleResource\Pages\ListSales;
use App\Models\Sale;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SalesOverview extends BaseWidget
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

        return [

            Stat::make('Ventas Ciudad Alternativa', '$'.$this->getPageTableQuery()->sum('total_sale'))
                ->description('Neto de Ventas al '.now()->format('d-m-Y'))
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total pagos en Dolares($)', '$'.$this->getPageTableQuery()->sum('pay_usd'))
                ->description('Total de pagos en Dolares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total pagos en Bolivares(Bs.)', 'Bs. '.number_format($this->getPageTableQuery()->sum('pay_bsd'), 2, ',', '.'))
                ->description('Total de pagos en Bolívares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 2, 1, 1, 15, 4, 2]),
        ];
    }
}
