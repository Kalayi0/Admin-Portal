<?php

namespace App\Filament\Resources\ServiceStatuses;

use App\Filament\Resources\ServiceStatuses\Pages\CreateServiceStatus;
use App\Filament\Resources\ServiceStatuses\Pages\EditServiceStatus;
use App\Filament\Resources\ServiceStatuses\Pages\ListServiceStatuses;
use App\Filament\Resources\ServiceStatuses\Schemas\ServiceStatusForm;
use App\Filament\Resources\ServiceStatuses\Tables\ServiceStatusesTable;
use App\Models\ServiceStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceStatusResource extends Resource
{
    protected static ?string $model = ServiceStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $recordTitleAttribute = 'ServiceStatus';

    public static function form(Schema $schema): Schema
    {
        return ServiceStatusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceStatusesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceStatuses::route('/'),
            'create' => CreateServiceStatus::route('/create'),
            'edit' => EditServiceStatus::route('/{record}/edit'),
        ];
    }
}
