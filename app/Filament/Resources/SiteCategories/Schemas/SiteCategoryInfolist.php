<?php

namespace App\Filament\Resources\SiteCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class SiteCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('Name')),
                TextEntry::make('slug')
                    ->label(__('Slug')),
                TextEntry::make('description')
                    ->label(__('Description'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('icon')
                    ->label(__('Icon')),
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
