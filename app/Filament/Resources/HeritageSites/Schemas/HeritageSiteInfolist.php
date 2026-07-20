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
                    ->translateLabel(),
                TextEntry::make('slug')
                    ->translateLabel(),
                TextEntry::make('description')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('address')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('latitude')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('longitude')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('registration_number')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('designation_year')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->translateLabel()
                    ->badge(),
                IconEntry::make('is_facility_available')
                    ->label(__('Facility Available'))
                    ->boolean(),
                TextEntry::make('creator.name')
                    ->label(__('Created by')),
                TextEntry::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
