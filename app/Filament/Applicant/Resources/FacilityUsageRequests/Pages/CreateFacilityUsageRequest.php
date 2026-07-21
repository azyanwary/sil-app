<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Pages;

use App\Filament\Applicant\Resources\FacilityUsageRequests\FacilityUsageRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFacilityUsageRequest extends CreateRecord
{
    protected static string $resource = FacilityUsageRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['applicant_id'] = auth()->id();
        $data['status'] = 'draft';
        
        return $data;
    }
}
