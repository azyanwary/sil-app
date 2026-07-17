<?php

namespace App\Filament\Resources\SiteConditionReports\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteConditionReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('site.name')
                    ->label('Situs'),
                TextEntry::make('surveyor.name')
                    ->label('Surveyor'),
                TextEntry::make('survey_date')
                    ->date(),
                TextEntry::make('condition')
                    ->badge(),
                TextEntry::make('findings')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('recommendation')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_urgent')
                    ->boolean(),
                TextEntry::make('responder.name')
                    ->label('Direspon oleh')
                    ->placeholder('-'),
                TextEntry::make('responded_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('response_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
