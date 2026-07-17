<?php

namespace App\Filament\Resources\SiteConditionReports\Pages;

use App\Filament\Resources\SiteConditionReports\SiteConditionReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiteConditionReport extends ViewRecord
{
    protected static string $resource = SiteConditionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
