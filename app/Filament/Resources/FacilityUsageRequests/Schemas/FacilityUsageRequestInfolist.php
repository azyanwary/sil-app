<?php

namespace App\Filament\Resources\FacilityUsageRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityUsageRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('request_number')
                    ->translateLabel(),
                TextEntry::make('user.name')
                    ->label(__('Applicant')),
                TextEntry::make('site.name')
                    ->label(__('Site')),
                TextEntry::make('applicant_name')
                    ->translateLabel(),
                TextEntry::make('identity_number')
                    ->translateLabel(),
                TextEntry::make('institution_name')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('activity_type')
                    ->translateLabel(),
                TextEntry::make('activity_description')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->translateLabel()
                    ->date(),
                TextEntry::make('end_date')
                    ->translateLabel()
                    ->date(),
                TextEntry::make('duration_days')
                    ->translateLabel()
                    ->suffix(' ' . __('days')),
                TextEntry::make('participant_count')
                    ->translateLabel()
                    ->suffix(' ' . __('people')),
                TextEntry::make('status')
                    ->translateLabel()
                    ->badge(),
                TextEntry::make('approval_notes')
                    ->translateLabel()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('permit_number')
                    ->translateLabel()
                    ->placeholder('-'),
                TextEntry::make('fee_amount')
                    ->translateLabel()
                    ->money('IDR'),
                TextEntry::make('reviewer.name')
                    ->label(__('Reviewed by'))
                    ->placeholder('-'),
                TextEntry::make('reviewed_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
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

