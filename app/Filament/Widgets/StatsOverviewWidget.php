<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        return [
            Stat::make('Total Open Tasks', Task::whereIn('status', ['pending', 'in_progress'])->count())
                ->description('Pending or in progress')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
                
            Stat::make('Completed This Week', Task::where('status', 'completed')
                ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                ->count())
                ->description('Across the entire team')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Overdue Tasks', Task::where('status', '!=', 'completed')
                ->where('due_date', '<', Carbon::today())
                ->count())
                ->description('Requires immediate action')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),
        ];
    }
}
