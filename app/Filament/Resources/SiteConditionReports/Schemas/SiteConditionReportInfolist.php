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
                    ->label(__('Site')),
                TextEntry::make('surveyor.name')
                    ->label(__('Surveyor')),
                TextEntry::make('survey_date')
                    ->translateLabel()
                    ->date(),
                TextEntry::make('condition')
                    ->translateLabel()
                    ->badge(),
                TextEntry::make('findings')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('recommendation')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_urgent')
                    ->label(__('Urgent'))
                    ->boolean(),
                TextEntry::make('responder.name')
                    ->label(__('Responded by'))
                    ->placeholder('-'),
                TextEntry::make('responded_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('response_notes')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
