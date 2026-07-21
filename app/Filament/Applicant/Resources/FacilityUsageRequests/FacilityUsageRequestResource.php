<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests;

use App\Filament\Applicant\Resources\FacilityUsageRequests\Pages\CreateFacilityUsageRequest;
use App\Filament\Applicant\Resources\FacilityUsageRequests\Pages\ListFacilityUsageRequests;
use App\Filament\Applicant\Resources\FacilityUsageRequests\Pages\ViewFacilityUsageRequest;
use App\Filament\Applicant\Resources\FacilityUsageRequests\Schemas\FacilityUsageRequestForm;
use App\Filament\Applicant\Resources\FacilityUsageRequests\Schemas\FacilityUsageRequestInfolist;
use App\Filament\Applicant\Resources\FacilityUsageRequests\Tables\FacilityUsageRequestsTable;
use App\Models\FacilityUsageRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityUsageRequestResource extends Resource
{
    protected static ?string $model = FacilityUsageRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('applicant_id', auth()->id())
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
