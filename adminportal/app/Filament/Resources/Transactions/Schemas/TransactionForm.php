<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\DateTimePicker;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->required(),
                Select::make('payment_method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Bank Transfer',
                    ]),
                DateTimePicker::make('completed_at'),
            ]);
    }
}