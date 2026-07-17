<?php

namespace App\Filament\Resources\HeritageSites\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeritageSiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('site_category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                TextInput::make('registration_number')
                    ->required(),
                TextInput::make('designation_year')
                    ->required(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'under_renovation' => 'Under Renovation',
                        'temporarily_closed' => 'Temporarily Closed',
                    ])
                    ->default('active')
                    ->required(),
                Toggle::make('is_facility_available')
                    ->default(true),
                Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->required(),
            ]);
    }
}
