<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class SaleOnlineChart extends ChartWidget
{
    protected static ?string $heading = 'ON-LINE';

    protected static ?int $sort = 1;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = Trend::query(Sale::where('type_sale', 'on-line'))
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->sum('total_sale');
 
    return [

        'datasets' => [
            [
                'label' => 'On-Line',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'fill' => 'start',
            ],
            ],
            'labels' => ($data->map(fn (TrendValue $value) => Carbon::parse($value->date)->isoFormat('dddd, D MMM'))->toArray()),
        ];
    }

    public function getDescription(): ?string
    {
        return 'Venta diaria en ON-Line';
    }

    protected function getType(): string
    {
        return 'line';
    }
}
