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
                    ->label(__('Site'))
                    ->searchable(),
                TextColumn::make('surveyor.name')
                    ->label(__('Surveyor'))
                    ->searchable(),
                TextColumn::make('survey_date')
                    ->label(__('Survey Date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('condition')
                    ->label(__('Condition'))
                    ->badge()
                    ->searchable(),
                IconColumn::make('is_urgent')
                    ->label(__('Urgent'))
                    ->boolean(),
                TextColumn::make('responder.name')
                    ->label(__('Responded by'))
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
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
