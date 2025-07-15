<?php

namespace App\Filament\Resources\TourismResource\Pages;

use App\Filament\Resources\TourismResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourisms extends ListRecords
{
    protected static string $resource = TourismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
