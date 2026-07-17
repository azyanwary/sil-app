<?php

namespace App\Filament\Resources\HeritageSites\Pages;

use App\Filament\Resources\HeritageSites\HeritageSiteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHeritageSites extends ListRecords
{
    protected static string $resource = HeritageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
