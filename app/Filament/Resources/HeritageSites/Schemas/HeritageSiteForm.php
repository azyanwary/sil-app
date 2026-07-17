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
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->label(__('Address'))
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->label(__('Latitude'))
                    ->required()
                    ->numeric(),
                TextInput::make('longitude')
                    ->label(__('Longitude'))
                    ->required()
                    ->numeric(),
                TextInput::make('registration_number')
                    ->label(__('Registration Number'))
                    ->required(),
                TextInput::make('designation_year')
                    ->label(__('Designation Year'))
                    ->required(),
                Select::make('status')
                    ->label(__('Status'))
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
