<?php

namespace App\Filament\Resources\TourismResource\Pages;

use App\Filament\Resources\TourismResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateTourism extends CreateRecord
{
    protected static string $resource = TourismResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }
}
