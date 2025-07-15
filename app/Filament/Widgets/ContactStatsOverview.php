<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pesan Kontak', Contact::count())
                ->description('Jumlah pesan kontak masuk')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('warning'),
            Stat::make('Pesan Belum Dibaca', Contact::where('status', 'new')->count())
                ->description('Pesan kontak baru yang belum dibaca')
                ->descriptionIcon('heroicon-o-inbox')
                ->color('danger'),
        ];
    }
}
