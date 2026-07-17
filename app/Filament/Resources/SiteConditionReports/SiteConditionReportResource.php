<?php

namespace App\Filament\Resources\SiteConditionReports;

use App\Filament\Resources\SiteConditionReports\Pages\CreateSiteConditionReport;
use App\Filament\Resources\SiteConditionReports\Pages\EditSiteConditionReport;
use App\Filament\Resources\SiteConditionReports\Pages\ListSiteConditionReports;
use App\Filament\Resources\SiteConditionReports\Pages\ViewSiteConditionReport;
use App\Filament\Resources\SiteConditionReports\Schemas\SiteConditionReportForm;
use App\Filament\Resources\SiteConditionReports\Schemas\SiteConditionReportInfolist;
use App\Filament\Resources\SiteConditionReports\Tables\SiteConditionReportsTable;
use App\Models\SiteConditionReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteConditionReportResource extends Resource
{
    protected static ?string $model = SiteConditionReport::class;

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string | \UnitEnum | null $navigationGroup = 'Situs Cagar Budaya';

    public static function form(Schema $schema): Schema
    {
        return SiteConditionReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteConditionReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteConditionReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteConditionReports::route('/'),
            'create' => CreateSiteConditionReport::route('/create'),
            'view' => ViewSiteConditionReport::route('/{record}'),
            'edit' => EditSiteConditionReport::route('/{record}/edit'),
        ];
    }
}
