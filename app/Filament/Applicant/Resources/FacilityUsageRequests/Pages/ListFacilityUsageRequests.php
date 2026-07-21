<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Pages;

use App\Filament\Applicant\Resources\FacilityUsageRequests\FacilityUsageRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFacilityUsageRequests extends ListRecords
{
    protected static string $resource = FacilityUsageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
