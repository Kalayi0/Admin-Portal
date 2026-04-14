<?php

namespace App\Filament\Resources\ServiceStatuses\Schemas;

use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\DateTimePicker;
use Filament\Schemas\Schema;

class ServiceStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_name')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        'online' => 'Online',
                        'warning' => 'Warning',
                        'offline' => 'Offline',
                    ])
                    ->required(),
                TextInput::make('response_time_ms')
                    ->numeric()
                    ->label('Response Time (ms)'),
                DateTimePicker::make('checked_at')
                    ->required(),
            ]);
    }
}