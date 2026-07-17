<?php

namespace App\Filament\Resources\HeritageSites\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HeritageSiteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.name')
                    ->label(__('Category')),
                TextEntry::make('name')
                    ->label(__('Name')),
                TextEntry::make('slug')
                    ->label(__('Slug')),
                TextEntry::make('description')
                    ->label(__('Description'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('address')
                    ->label(__('Address'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('latitude')
                    ->label(__('Latitude'))
                    ->placeholder('-'),
                TextEntry::make('longitude')
                    ->label(__('Longitude'))
                    ->placeholder('-'),
                TextEntry::make('registration_number')
                    ->label(__('Registration Number'))
                    ->placeholder('-'),
                TextEntry::make('designation_year')
                    ->label(__('Designation Year'))
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label(__('Status'))
                    ->badge(),
                IconEntry::make('is_facility_available')
                    ->label(__('Facility Available'))
                    ->boolean(),
                TextEntry::make('creator.name')
                    ->label(__('Created by')),
                TextEntry::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
