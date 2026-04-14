<?php

namespace App\Filament\Resources\ServiceStatuses\Pages;

use App\Filament\Resources\ServiceStatuses\ServiceStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceStatus extends EditRecord
{
    protected static string $resource = ServiceStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
