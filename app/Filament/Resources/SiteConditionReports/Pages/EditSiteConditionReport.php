<?php

namespace App\Filament\Resources\SiteConditionReports\Pages;

use App\Filament\Resources\SiteConditionReports\SiteConditionReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSiteConditionReport extends EditRecord
{
    protected static string $resource = SiteConditionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
