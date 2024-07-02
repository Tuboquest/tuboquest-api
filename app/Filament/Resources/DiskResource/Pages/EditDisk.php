<?php

namespace App\Filament\Resources\DiskResource\Pages;

use App\Filament\Resources\DiskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisk extends EditRecord
{
    protected static string $resource = DiskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
