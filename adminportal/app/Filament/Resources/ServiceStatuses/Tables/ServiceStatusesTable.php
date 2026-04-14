<?php

namespace App\Filament\Resources\ServiceStatuses\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class ServiceStatusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service_name')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'online',
                        'warning' => 'warning',
                        'danger' => 'offline',
                    ]),
                TextColumn::make('response_time_ms')
                    ->label('Response (ms)')
                    ->sortable(),
                TextColumn::make('checked_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->defaultSort('checked_at', 'desc')
            ->filters([])
            ->actions([EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }
}