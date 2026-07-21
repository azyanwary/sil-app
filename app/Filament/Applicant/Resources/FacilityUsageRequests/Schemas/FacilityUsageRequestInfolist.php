<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Schemas;

use App\Models\FacilityUsageRequest;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityUsageRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('request_number'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('heritage_site_id')
                    ->numeric(),
                TextEntry::make('applicant_name'),
                TextEntry::make('identity_number'),
                TextEntry::make('institution_name')
                    ->placeholder('-'),
                TextEntry::make('activity_type'),
                TextEntry::make('activity_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),
                TextEntry::make('duration_days')
                    ->numeric(),
                TextEntry::make('participant_count')
                    ->numeric(),
                TextEntry::make('application_letter_path'),
                TextEntry::make('status'),
                TextEntry::make('approval_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('permit_number')
                    ->placeholder('-'),
                TextEntry::make('fee_amount')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('reviewed_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('reviewed_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (FacilityUsageRequest $record): bool => $record->trashed()),
                TextEntry::make('applicant.name')
                    ->label('Applicant')
                    ->placeholder('-'),
            ]);
    }
}
