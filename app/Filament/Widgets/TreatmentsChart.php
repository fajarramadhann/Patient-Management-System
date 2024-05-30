<?php

namespace App\Filament\Widgets;

use App\Models\Treatment;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;

class TreatmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Treatments';

    protected function getData(): array
    {
            $data = Trend::model(Treatment::class)
                ->between(
                    start: now()->subMonth(),
                    end: now(),
                )
                ->perMonth()
                ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Treatments',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
