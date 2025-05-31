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


        // $saleUsd = Sale::where('type_sale', 'tienda-fisica')->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->sum('pay_usd');
        // dd($saleUsd);

        $pago_movil = $this->getPageTableQuery()->where('payment_method', 'pago-movil')->sum('pay_bsd');
        $pago_movil_multiMoneda = $this->getPageTableQuery()->where('payment_method', 'multi-moneda')->where('multiMoneda_method_bsd', 'pago-movil')->sum('pay_bsd');
        

        $total_pago_movil = $pago_movil + $pago_movil_multiMoneda;

        return [

            // Stat::make('Ventas Ciudad Alternativa', '$'.$this->getPageTableQuery()->where('type_sale', 'tienda-fisica')->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->sum('pay_usd'))
            //     ->description('Neto de Ventas al '.now()->format('d-m-Y'))
            //     ->descriptionIcon('heroicon-m-presentation-chart-line')
            //     ->color('success')
            //     ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total pagos en Dolares($)', 'US$'. $this->getPageTableQuery()->sum('pay_usd'))
                ->description('Total de pagos en Dolares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total pagos en Bolivares(Bs.)', 'Bs. '. $this->getPageTableQuery()->sum('pay_bsd'))
                ->description('Total de pagos en Bolívares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 2, 1, 1, 15, 4, 2]),

            Stat::make('Total Zelle', 'US$' . $this->getPageTableQuery()->where('payment_method', 'zelle')->sum('pay_usd'))
                ->description('Total de pagos en Dolares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total pagos en PagoMovil(Bs.)', 'Bs. ' . $total_pago_movil)
                ->description('Total de pagos en Bolívares')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 2, 1, 1, 15, 4, 2]),
        ];
    }

    public function getColumns(): int
    {
        return 2;
    }
}