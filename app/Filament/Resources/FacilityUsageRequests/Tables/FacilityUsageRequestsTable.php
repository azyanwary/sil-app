<?php

namespace App\Filament\Resources\FacilityUsageRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FacilityUsageRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('request_number')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label(__('Applicant'))
                    ->searchable(),
                TextColumn::make('site.name')
                    ->label(__('Site'))
                    ->searchable(),
                TextColumn::make('activity_type')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->translateLabel()
                    ->badge()
                    ->searchable(),
                TextColumn::make('fee_amount')
                    ->translateLabel()
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->translateLabel()
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

