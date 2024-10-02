<?php

namespace App\Filament\Widgets;

use App\Models\Grade;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PerformanceMetrics extends AdvancedChartWidget
{
    protected static ?string $heading = 'Student Performance';

    protected static string $color = 'info';
    protected static ?string $icon = 'heroicon-o-presentation-chart-line';
    protected static ?string $iconColor = 'info';
    protected static ?string $label = 'Average Monthly Score';

    protected static ?string $badge = 'new';
    protected static ?string $badgeColor = 'success';
    protected static ?string $badgeIcon = 'heroicon-o-check-circle';
    protected static ?string $badgeIconPosition = 'before';
    protected static ?string $badgeSize = 'sm';

    protected int | string | array $columnSpan = '2';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $averageScore = Grade::avg('score');
        $ratingOutOfTen = min(round($averageScore * 10 / 100, 1), 10);

        return [
            'datasets' => [
                [
                    'data' => [$ratingOutOfTen, 10 - $ratingOutOfTen],
                    'backgroundColor' => ['#3b82f6', '#e5e7eb'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => ['Rating', 'Remaining'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'responsive' => true,
            'cutout' => '50%',
            'rotation' => -90,
            'circumference' => 180,
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getFooterWidgets(): ?array
    {
        $averageScore = Grade::avg('score');
        $ratingOutOfTen = min(round($averageScore * 10 / 100, 1), 10);

        return [
            \Filament\Widgets\StatsOverviewWidget::class => [
                'stats' => [
                    [
                        'label' => 'Rating',
                        'value' => $ratingOutOfTen . ' / 10',
                    ],
                ],
            ],
        ];
    }
}
