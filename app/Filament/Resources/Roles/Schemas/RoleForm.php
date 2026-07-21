<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama Role / Peran')
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\TextInput::make('guard_name')
                    ->default('web')
                    ->required(),
                \Filament\Forms\Components\CheckboxList::make('permissions')
                    ->label('Hak Akses (Permissions)')
                    ->relationship('permissions', 'name')
                    ->getOptionLabelFromRecordUsing(fn (\Illuminate\Database\Eloquent\Model $record) => \App\Enums\PermissionType::tryFrom($record->name)?->label() ?? $record->name)
                    ->columns(2)
                    ->required(),
                \Filament\Forms\Components\Select::make('users')
                    ->label('Pengguna')
                    ->relationship('users', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
