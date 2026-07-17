<?php

namespace App\Filament\Resources\SiteCategories;

use App\Filament\Resources\SiteCategories\Pages\CreateSiteCategory;
use App\Filament\Resources\SiteCategories\Pages\EditSiteCategory;
use App\Filament\Resources\SiteCategories\Pages\ListSiteCategories;
use App\Filament\Resources\SiteCategories\Pages\ViewSiteCategory;
use App\Filament\Resources\SiteCategories\Schemas\SiteCategoryForm;
use App\Filament\Resources\SiteCategories\Schemas\SiteCategoryInfolist;
use App\Filament\Resources\SiteCategories\Tables\SiteCategoriesTable;
use App\Models\SiteCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteCategoryResource extends Resource
{
    protected static ?string $model = SiteCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | \UnitEnum | null $navigationGroup = 'Situs Cagar Budaya';
    
    public static function form(Schema $schema): Schema
    {
        return SiteCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteCategoriesTable::configure($table);
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
            'index' => ListSiteCategories::route('/'),
            'create' => CreateSiteCategory::route('/create'),
            'view' => ViewSiteCategory::route('/{record}'),
            'edit' => EditSiteCategory::route('/{record}/edit'),
        ];
    }
}
