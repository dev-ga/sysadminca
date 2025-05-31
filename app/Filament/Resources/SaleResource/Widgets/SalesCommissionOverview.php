<?php

namespace App\Filament\Resources\SaleResource\Widgets;

use App\Filament\Resources\SaleResource\Pages\ListSales;
use App\Models\Sale;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SalesCommissionOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListSales::class;
    }
    
    // protected function getStats(): array
    // {
    //     $data = Trend::model(Sale::class)
    //         ->between(
    //             start: now()->subYear(),
    //             end: now(),
    //         )
    //         ->perMonth();

    //     return [

    //         Stat::make('Comision en Dolares($ )', '$'.$this->getPageTableQuery()->sum('commission_usd'))
    //             ->description('Acumulado de comisiones')
    //             ->descriptionIcon('heroicon-c-users')
    //             ->color('info')
    //             ->chart([7, 2, 10, 3, 15, 4, 17]),

    //         Stat::make('Comision en Bolivares(Bs. )', 'Bs. '.$this->getPageTableQuery()->sum('commission_bsd'))
    //             ->description('Acumulado de comisiones')
    //             ->descriptionIcon('heroicon-c-users')
    //             ->color('info')
    //             ->chart([7, 2, 10, 3, 15, 4, 17]),

    //     ];
    // }

    public function getColumns(): int
    {
        return 2;
    }
}