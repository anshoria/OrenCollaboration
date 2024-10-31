<?php

namespace App\Filament\Widgets;

use App\Models\Projects;
use App\Models\TeamMember;
use App\Models\Services;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Projects', Projects::count())
                ->description('Total projects handled')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),
            
            Stat::make('Active Team Members', TeamMember::where('is_active', true)->count())
                ->description('Current team size')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            
            Stat::make('Services Offered', Services::count())
                ->description('Available services')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('warning'),
        ];
    }
}