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
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('slug')
                    ->translateLabel()
                    ->required(),
                Textarea::make('description')
                    ->translateLabel()
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->translateLabel()
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->translateLabel()
                    ->required()
                    ->numeric(),
                TextInput::make('longitude')
                    ->translateLabel()
                    ->required()
                    ->numeric(),
                TextInput::make('registration_number')
                    ->translateLabel()
                    ->required(),
                TextInput::make('designation_year')
                    ->translateLabel()
                    ->required(),
                Select::make('status')
                    ->translateLabel()
                    ->options([
                        'active' => __('Active'),
                        'under_renovation' => __('Under Renovation'),
                        'temporarily_closed' => __('Temporarily Closed'),
                    ])
                    ->default('active')
                    ->required(),
                Toggle::make('is_facility_available')
                    ->label(__('Facility Available'))
                    ->default(true),
                Select::make('created_by')
                    ->label(__('Created by'))
                    ->relationship('creator', 'name')
                    ->required(),
            ]);
    }
}
