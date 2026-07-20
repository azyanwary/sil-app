<?php

namespace App\Filament\Resources\HeritageSites\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use LaraZeus\SpatieTranslatable\Resources\RelationManagers\Concerns\Translatable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PhotosRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'photos';

    protected static ?string $recordTitleAttribute = 'caption';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label(__('Photo'))
                    ->image()
                    ->directory('site-photos')
                    ->imageEditor()
                    ->required(),
                TextInput::make('caption')
                    ->translateLabel(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label(__('Photo')),
                TextColumn::make('caption')
                    ->translateLabel()
                    ->formatStateUsing(fn ($record, $livewire) => $record?->getTranslation('caption', $livewire->activeLocale ?? app()->getLocale()))
                    ->searchable(),
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
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire) {
                        if (isset($livewire->activeLocale)) {
                            app()->setLocale($livewire->activeLocale);
                        }
                        return $data;
                    }),
                ActionGroup::make([
                    Action::make('locale_id')
                        ->label('Indonesia')
                        ->color(fn (RelationManager $livewire) => $livewire->activeLocale === 'id' ? 'primary' : 'gray')
                        ->action(fn (RelationManager $livewire) => $livewire->activeLocale = 'id'),
                    Action::make('locale_en')
                        ->label('English')
                        ->color(fn (RelationManager $livewire) => $livewire->activeLocale === 'en' ? 'primary' : 'gray')
                        ->action(fn (RelationManager $livewire) => $livewire->activeLocale = 'en'),
                ])
                ->label(fn (RelationManager $livewire) => $livewire->activeLocale === 'en' ? 'English' : 'Indonesia')
                ->icon('heroicon-m-language')
                ->button(),
            ])
            ->actions([
                ViewAction::make()
                    ->mutateRecordDataUsing(function (array $data, Model $record, RelationManager $livewire) {
                        $data['caption'] = $record->getTranslation('caption', $livewire->activeLocale ?? app()->getLocale());
                        return $data;
                    }),
                EditAction::make()
                    ->mutateRecordDataUsing(function (array $data, Model $record, RelationManager $livewire) {
                        $data['caption'] = $record->getTranslation('caption', $livewire->activeLocale ?? app()->getLocale());
                        return $data;
                    })
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire) {
                        if (isset($livewire->activeLocale)) {
                            app()->setLocale($livewire->activeLocale);
                        }
                        return $data;
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
