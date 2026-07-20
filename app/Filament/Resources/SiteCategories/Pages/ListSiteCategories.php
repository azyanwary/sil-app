<?php

namespace App\Filament\Resources\SiteCategories\Pages;

use App\Filament\Resources\SiteCategories\SiteCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListSiteCategories extends ListRecords
{
    use Translatable;

    protected static string $resource = SiteCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
