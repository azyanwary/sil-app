<?php

namespace App\Filament\Resources\FacilityUsageRequests;

use App\Filament\Resources\FacilityUsageRequests\Pages\CreateFacilityUsageRequest;
use App\Filament\Resources\FacilityUsageRequests\Pages\EditFacilityUsageRequest;
use App\Filament\Resources\FacilityUsageRequests\Pages\ListFacilityUsageRequests;
use App\Filament\Resources\FacilityUsageRequests\Pages\ViewFacilityUsageRequest;
use App\Filament\Resources\FacilityUsageRequests\Schemas\FacilityUsageRequestForm;
use App\Filament\Resources\FacilityUsageRequests\Schemas\FacilityUsageRequestInfolist;
use App\Filament\Resources\FacilityUsageRequests\Tables\FacilityUsageRequestsTable;
use App\Models\FacilityUsageRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FacilityUsageRequestResource extends Resource
{
    protected static ?string $model = FacilityUsageRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string | \UnitEnum | null $navigationGroup = 'Layanan';

    public static function form(Schema $schema): Schema
    {
        return FacilityUsageRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FacilityUsageRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacilityUsageRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFacilityUsageRequests::route('/'),
            'create' => CreateFacilityUsageRequest::route('/create'),
            'view' => ViewFacilityUsageRequest::route('/{record}'),
            'edit' => EditFacilityUsageRequest::route('/{record}/edit'),
        ];
    }
}
