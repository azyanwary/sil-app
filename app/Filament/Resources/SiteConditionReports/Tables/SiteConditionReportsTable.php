<?php

namespace App\Filament\Resources\SiteConditionReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteConditionReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site.name')
                    ->label('Situs')
                    ->searchable(),
                TextColumn::make('surveyor.name')
                    ->label('Surveyor')
                    ->searchable(),
                TextColumn::make('survey_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('condition')
                    ->badge()
                    ->searchable(),
                IconColumn::make('is_urgent')
                    ->boolean(),
                TextColumn::make('responder.name')
                    ->label('Direspon oleh')
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
