<?php

namespace App\Filament\Resources\FacilityUsageRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FacilityUsageRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('request_number')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('heritage_site_id')
                    ->relationship('site', 'name')
                    ->required(),
                TextInput::make('applicant_name')
                    ->required(),
                TextInput::make('identity_number')
                    ->required(),
                TextInput::make('institution_name'),
                TextInput::make('activity_type')
                    ->required(),
                Textarea::make('activity_description')
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                TextInput::make('duration_days')
                    ->numeric(),
                TextInput::make('participant_count')
                    ->numeric(),
                FileUpload::make('application_letter_path')
                    ->directory('application-letters'),
                Select::make('status')
                    ->options([
                        'submitted' => 'Submitted',
                        'verified' => 'Verified',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('submitted')
                    ->required(),
                Textarea::make('approval_notes')
                    ->columnSpanFull(),
                TextInput::make('permit_number'),
                TextInput::make('fee_amount')
                    ->numeric()
                    ->default(0),
                Select::make('reviewed_by')
                    ->relationship('reviewer', 'name'),
            ]);
    }
}
