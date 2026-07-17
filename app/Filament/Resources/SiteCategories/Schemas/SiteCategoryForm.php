<?php

namespace App\Filament\Resources\SiteCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SiteCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
                FileUpload::make('icon')
                    ->label(__('Icon'))
                    ->image()
                    ->directory('site-categories'),
            ]);
    }
}
