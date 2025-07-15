<?php

namespace App\Filament\Widgets;

use App\Models\Hospital;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HospitalStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Rumah Sakit', Hospital::count())
                ->description('Jumlah rumah sakit terdaftar')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('info'),
        ];
    }
}
