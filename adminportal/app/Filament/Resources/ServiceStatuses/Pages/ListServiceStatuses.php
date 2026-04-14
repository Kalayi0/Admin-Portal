<?php

namespace App\Filament\Resources\ServiceStatuses\Pages;

use App\Filament\Resources\ServiceStatuses\ServiceStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceStatuses extends ListRecords
{
    protected static string $resource = ServiceStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
