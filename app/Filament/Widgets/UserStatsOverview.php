<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),
            Stat::make('Pengguna Admin', User::where('is_admin', true)->count())
                ->description('Jumlah pengguna dengan hak admin')
                ->descriptionIcon('heroicon-o-shield-check')
                ->color('success'),
        ];
    }
}
