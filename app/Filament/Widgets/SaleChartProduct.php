<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use App\Models\SaleDetail;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SaleChartProduct extends ChartWidget
{
    // use InteractsWithPageFilters;

    protected static ?string $heading = 'VENTAS DIARIAS POR PRODUCTO';

    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = 'full';

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = DB::table('sale_details')
        ->select(DB::raw('SUM(quantity) as quantity, sku'))
        ->groupBy('sku')
        ->get();
 
        return [

            'datasets' => [
                    [
                        'label' => 'Movimiento de Productos',
                        'data' => $data->map(fn ($data) => $data->quantity),
                        'backgroundColor' => '#22c55e',
                        'borderColor' => '#22c55e',
                        'fill' => true,
                    ],
                ],
                'labels' => ($data->map(fn ($data) => $data->sku)),
        ];
    }

    public function getDescription(): ?string
    {
        return 'Venta neta por dia';
    }

    protected function getType(): string
    {
        return 'line';
    }
}

