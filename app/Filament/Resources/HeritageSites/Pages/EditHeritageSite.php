<?php

namespace App\Filament\Resources\HeritageSites\Pages;

use App\Filament\Resources\HeritageSites\HeritageSiteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHeritageSite extends EditRecord
{
    protected static string $resource = HeritageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
