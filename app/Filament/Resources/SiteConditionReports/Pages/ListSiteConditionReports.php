<?php

namespace App\Filament\Resources\SiteConditionReports\Pages;

use App\Filament\Resources\SiteConditionReports\SiteConditionReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiteConditionReports extends ListRecords
{
    protected static string $resource = SiteConditionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
