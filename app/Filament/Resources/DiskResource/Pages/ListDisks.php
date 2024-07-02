<?php

namespace App\Filament\Resources\DiskResource\Pages;

use App\Filament\Resources\DiskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisks extends ListRecords
{
    protected static string $resource = DiskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
