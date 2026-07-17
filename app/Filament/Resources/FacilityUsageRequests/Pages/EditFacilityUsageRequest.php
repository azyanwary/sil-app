<?php

namespace App\Filament\Resources\FacilityUsageRequests\Pages;

use App\Filament\Resources\FacilityUsageRequests\FacilityUsageRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFacilityUsageRequest extends EditRecord
{
    protected static string $resource = FacilityUsageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
