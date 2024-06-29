<?php

namespace App\Filament\Resources\ParkSessionResource\Pages;

use App\Filament\Resources\ParkSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParkSessions extends ListRecords
{
    protected static string $resource = ParkSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
