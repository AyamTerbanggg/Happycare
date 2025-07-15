<?php

namespace App\Filament\Widgets;

use App\Models\Tourism;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TourismStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tempat Wisata', Tourism::count())
                ->description('Jumlah tempat wisata terdaftar')
                ->descriptionIcon('heroicon-o-map')
                ->color('success'),
        ];
    }
}
