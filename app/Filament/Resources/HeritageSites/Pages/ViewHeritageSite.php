<?php

namespace App\Filament\Resources\HeritageSites\Pages;

use App\Filament\Resources\HeritageSites\HeritageSiteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHeritageSite extends ViewRecord
{
    protected static string $resource = HeritageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
