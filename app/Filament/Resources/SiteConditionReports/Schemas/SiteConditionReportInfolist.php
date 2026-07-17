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
                    ->label(__('Survey Date'))
                    ->date(),
                TextEntry::make('condition')
                    ->label(__('Condition'))
                    ->badge(),
                TextEntry::make('findings')
                    ->label(__('Findings'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('recommendation')
                    ->label(__('Recommendation'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_urgent')
                    ->label(__('Urgent'))
                    ->boolean(),
                TextEntry::make('responder.name')
                    ->label(__('Responded by'))
                    ->placeholder('-'),
                TextEntry::make('responded_at')
                    ->label(__('Responded At'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('response_notes')
                    ->label(__('Response Notes'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
