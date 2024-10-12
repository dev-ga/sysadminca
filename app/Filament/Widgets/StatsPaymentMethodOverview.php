<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use App\Models\TasaBcv;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsPaymentMethodOverview extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $tasa = TasaBcv::where('date', now()->format('d-m-Y'))->first();
        $bolivares = Sale::where('payment_method', 'pago-movil')->sum('pay_bsd');
        $total_en_dolares = $bolivares / $tasa->tasa;
        
        return [
            Stat::make('Pago en Zelle($)', '$'.Sale::where('payment_method', 'zelle')->sum('pay_usd'))
                ->description('Neto de Ventas al '.now()->format('d-m-Y'))
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Pago en Banecos Panama($)', '$'.Sale::where('payment_method', 'banesco-panama')->sum('pay_usd'))
                ->description('Total de pagos en Dolares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Pagos en Pago Movil(Bs.)', 'Bs. '.number_format(Sale::where('payment_method', 'pago-movil')->sum('pay_bsd'), 2, ',', '.'))
                ->description('Conversion en Dolares. '.round($total_en_dolares))
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 2, 1, 1, 15, 4, 2]),
        ];
    }
}
