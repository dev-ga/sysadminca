<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class SalePisoVentaChart extends ChartWidget
{
    protected static ?string $heading = 'PISO DE VENTAS';

    protected static ?int $sort = 2;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = Trend::query(Sale::where('type_sale', 'tienda-fisica'))
        ->between(
            start: now()->startOfDay(),
            end: now()->endOfDay(),
        )
        ->perDay()
        ->sum('total_sale');
 
    return [

        'datasets' => [
            [
                'label' => 'Piso de Ventas',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'fill' => true,
            ],
            ],
            'labels' => ($data->map(fn (TrendValue $value) => Carbon::parse($value->date)->isoFormat('dddd, D MMM'))->toArray()),
        ];
    }

    public function getDescription(): ?string
    {
        return 'Venta diaria en piso de venta';
    }

    protected function getType(): string
    {
        return 'line';
    }
}
