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
                    ->translateLabel()
                    ->required(),
                Select::make('user_id')
                    ->label(__('Applicant'))
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('heritage_site_id')
                    ->label(__('Site'))
                    ->relationship('site', 'name', modifyQueryUsing: fn ($query) => $query->orderBy('id'))
                    ->required(),
                TextInput::make('applicant_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('identity_number')
                    ->translateLabel()
                    ->required(),
                TextInput::make('institution_name')
                    ->translateLabel(),
                TextInput::make('activity_type')
                    ->translateLabel()
                    ->required(),
                Textarea::make('activity_description')
                    ->translateLabel()
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->translateLabel()
                    ->required(),
                DatePicker::make('end_date')
                    ->translateLabel()
                    ->required(),
                TextInput::make('duration_days')
                    ->translateLabel()
                    ->numeric(),
                TextInput::make('participant_count')
                    ->translateLabel()
                    ->numeric(),
                FileUpload::make('application_letter_path')
                    ->label(__('Application Letter'))
                    ->directory('application-letters'),
                Select::make('status')
                    ->translateLabel()
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
                    ->translateLabel()
                    ->columnSpanFull(),
                TextInput::make('permit_number')
                    ->translateLabel(),
                TextInput::make('fee_amount')
                    ->translateLabel()
                    ->numeric()
                    ->default(0),
                Select::make('reviewed_by')
                    ->label(__('Reviewed by'))
                    ->relationship('reviewer', 'name'),
            ]);
    }
}

