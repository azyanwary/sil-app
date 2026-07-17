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
                    ->label(__('Request Number')),
                TextEntry::make('user.name')
                    ->label(__('Applicant')),
                TextEntry::make('site.name')
                    ->label(__('Site')),
                TextEntry::make('applicant_name')
                    ->label(__('Applicant Name')),
                TextEntry::make('identity_number')
                    ->label(__('Identity Number')),
                TextEntry::make('institution_name')
                    ->label(__('Institution Name'))
                    ->placeholder('-'),
                TextEntry::make('activity_type')
                    ->label(__('Activity Type')),
                TextEntry::make('activity_description')
                    ->label(__('Activity Description'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->label(__('Start Date'))
                    ->date(),
                TextEntry::make('end_date')
                    ->label(__('End Date'))
                    ->date(),
                TextEntry::make('duration_days')
                    ->label(__('Duration Days'))
                    ->suffix(' ' . __('days')),
                TextEntry::make('participant_count')
                    ->label(__('Participant Count'))
                    ->suffix(' ' . __('people')),
                TextEntry::make('status')
                    ->label(__('Status'))
                    ->badge(),
                TextEntry::make('approval_notes')
                    ->label(__('Approval Notes'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('permit_number')
                    ->label(__('Permit Number'))
                    ->placeholder('-'),
                TextEntry::make('fee_amount')
                    ->label(__('Fee Amount'))
                    ->money('IDR'),
                TextEntry::make('reviewer.name')
                    ->label(__('Reviewed by'))
                    ->placeholder('-'),
                TextEntry::make('reviewed_at')
                    ->label(__('Reviewed At'))
                    ->dateTime()
                    ->placeholder('-'),
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
