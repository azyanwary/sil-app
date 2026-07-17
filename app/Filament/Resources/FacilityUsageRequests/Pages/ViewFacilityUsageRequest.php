<?php

namespace App\Filament\Resources\FacilityUsageRequests\Pages;

use App\Filament\Resources\FacilityUsageRequests\FacilityUsageRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFacilityUsageRequest extends ViewRecord
{
    protected static string $resource = FacilityUsageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
