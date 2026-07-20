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
                    ->options(collect(\App\Enums\PermissionType::cases())->mapWithKeys(fn ($enum) => [$enum->value => $enum->label()])->toArray())
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\TextInput::make('guard_name')
                    ->default('web')
                    ->required(),
            ]);
    }
}
