<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('name')
                    ->label('Nama Permission (Modul)')
                    ->options(\App\Enums\PermissionType::class)
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\TextInput::make('guard_name')
                    ->default('web')
                    ->required(),
            ]);
    }
}
