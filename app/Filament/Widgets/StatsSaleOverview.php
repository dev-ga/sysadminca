<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsSaleOverview extends BaseWidget
{
    protected static ?int $sort = -3;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Ventas Ciudad Alternativa', '$'.Sale::sum('total_sale'))
                ->description('Neto de Ventas al '.now()->format('d-m-Y'))
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            // Stat::make('Total pagos en Dolares($)', '$'.Sale::sum('pay_usd'))
            //     ->description('Total de pagos en Dolares')
            //     ->descriptionIcon('heroicon-m-shopping-bag')
            //     ->color('warning')
            //     ->chart([7, 2, 10, 3, 15, 4, 17]),

            // Stat::make('Total pagos en Bolivares(Bs.)', 'Bs. '.number_format(Sale::sum('pay_bsd'), 2, ',', '.'))
            //     ->description('Total de pagos en Bolívares')
            //     ->descriptionIcon('heroicon-m-shopping-bag')
            //     ->color('primary')
            //     ->chart([7, 2, 1, 1, 15, 4, 2]),
        ];
    }
}
