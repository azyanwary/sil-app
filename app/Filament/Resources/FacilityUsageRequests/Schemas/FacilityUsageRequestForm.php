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
                    ->label(__('Request Number'))
                    ->required(),
                Select::make('user_id')
                    ->label(__('Applicant'))
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('heritage_site_id')
                    ->label(__('Site'))
                    ->relationship('site', 'name')
                    ->required(),
                TextInput::make('applicant_name')
                    ->label(__('Applicant Name'))
                    ->required(),
                TextInput::make('identity_number')
                    ->label(__('Identity Number'))
                    ->required(),
                TextInput::make('institution_name')
                    ->label(__('Institution Name')),
                TextInput::make('activity_type')
                    ->label(__('Activity Type'))
                    ->required(),
                Textarea::make('activity_description')
                    ->label(__('Activity Description'))
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->label(__('Start Date'))
                    ->required(),
                DatePicker::make('end_date')
                    ->label(__('End Date'))
                    ->required(),
                TextInput::make('duration_days')
                    ->label(__('Duration Days'))
                    ->numeric(),
                TextInput::make('participant_count')
                    ->label(__('Participant Count'))
                    ->numeric(),
                FileUpload::make('application_letter_path')
                    ->label(__('Application Letter'))
                    ->directory('application-letters'),
                Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'submitted' => __('Submitted'),
                        'verified' => __('Verified'),
                        'approved' => __('Approved'),
                        'rejected' => __('Rejected'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                    ])
                    ->default('submitted')
                    ->required(),
                Textarea::make('approval_notes')
                    ->label(__('Approval Notes'))
                    ->columnSpanFull(),
                TextInput::make('permit_number')
                    ->label(__('Permit Number')),
                TextInput::make('fee_amount')
                    ->label(__('Fee Amount'))
                    ->numeric()
                    ->default(0),
                Select::make('reviewed_by')
                    ->label(__('Reviewed by'))
                    ->relationship('reviewer', 'name'),
            ]);
    }
}
