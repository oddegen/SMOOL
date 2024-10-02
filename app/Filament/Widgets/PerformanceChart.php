<?php

namespace App\Filament\Widgets;

use App\Models\Grade;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Student Performance';

    protected function getData(): array
    {
        $data = Trend::query(Grade::query())
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->average('score');

        return [
            'datasets' => [
                [
                    'label' => 'Average Score',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
