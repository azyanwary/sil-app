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
                    ->label('Kategori'),
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('latitude')
                    ->placeholder('-'),
                TextEntry::make('longitude')
                    ->placeholder('-'),
                TextEntry::make('registration_number')
                    ->placeholder('-'),
                TextEntry::make('designation_year')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge(),
                IconEntry::make('is_facility_available')
                    ->boolean(),
                TextEntry::make('creator.name')
                    ->label('Dibuat oleh'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
