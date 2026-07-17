<?php

namespace App\Filament\Resources\SiteCategories\Pages;

use App\Filament\Resources\SiteCategories\SiteCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiteCategory extends ViewRecord
{
    protected static string $resource = SiteCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
