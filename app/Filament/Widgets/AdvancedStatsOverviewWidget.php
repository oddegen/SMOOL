<?php

namespace App\Filament\Widgets;

use App\Models\User;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;

class AdvancedStatsOverviewWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            $this->getUserStat('Total Students', 3, 'heroicon-o-user-circle'),
            $this->getUserStat('Total Teachers', 2, 'heroicon-o-academic-cap'),
            $this->getUserStat('Total Staff', 1, 'heroicon-o-shield-check'),
        ];
    }

    protected function getUserStat(string $label, int $roleId, string $icon): Stat
    {
        $count = User::where('role_id', $roleId)->count();
        $trend = $this->getYearlyTrend($roleId);

        $stat = Stat::make($label, $count)
            ->iconPosition('start')
            ->description($this->getTrendDescription($trend))
            ->descriptionIcon($this->getTrendIcon($trend), 'before')
            ->icon($icon);

        if ($trend->contains(fn($item) => $item->aggregate > 0)) {
            $stat
                ->chart($trend->pluck('aggregate')->toArray())
                ->chartColor($this->getTrendColor($trend))
                ->iconColor($this->getTrendColor($trend));
        }

        return $stat;
    }

    protected function getYearlyTrend(int $roleId): \Illuminate\Support\Collection
    {
        return Trend::query(User::where('role_id', $roleId))
            ->between(
                start: now()->startOfYear()->subYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
    }

    protected function getTrendDescription(\Illuminate\Support\Collection $trend): string
    {
        $latestValue = $trend->last(function ($item) {
            return $item && $item->aggregate > 0;
        });
        $previousValue = $trend->first(function ($item) {
            return $item && $item->aggregate > 0;
        });

        if (!$latestValue || !$previousValue) {
            return 'No trend data available';
        }

        $difference = $latestValue->aggregate - $previousValue->aggregate;
        return ($difference >= 0 ? '+' : '') . $difference . ' from last month';
    }

    protected function getTrendIcon(\Illuminate\Support\Collection $trend): string
    {
        $latestValue = $trend->last(function ($item) {
            return $item && $item->aggregate > 0;
        });
        $previousValue = $trend->first(function ($item) {
            return $item && $item->aggregate > 0;
        });

        if (!$latestValue || !$previousValue) {
            return 'heroicon-m-minus';
        }

        return $latestValue->aggregate >= $previousValue->aggregate
            ? 'heroicon-m-arrow-trending-up'
            : 'heroicon-m-arrow-trending-down';
    }

    protected function getTrendColor(\Illuminate\Support\Collection $trend): string
    {
        $latestValue = $trend->last(function ($item) {
            return $item && $item->aggregate > 0;
        });
        $previousValue = $trend->first(function ($item) {
            return $item && $item->aggregate > 0;
        });

        if (!$latestValue || !$previousValue) {
            return '';
        }

        return $latestValue->aggregate >= $previousValue->aggregate
            ? 'success'
            : 'danger';
    }
}
