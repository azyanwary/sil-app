<?php

namespace App\Filament\Resources\SiteCategories\Pages;

use App\Filament\Resources\SiteCategories\SiteCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateSiteCategory extends CreateRecord
{
    use Translatable;

    protected static string $resource = SiteCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
