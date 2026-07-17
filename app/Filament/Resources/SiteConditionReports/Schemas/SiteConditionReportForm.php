<?php

namespace App\Filament\Resources\SiteConditionReports\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteConditionReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('heritage_site_id')
                    ->relationship('site', 'name')
                    ->required(),
                Select::make('surveyor_id')
                    ->relationship('surveyor', 'name')
                    ->required(),
                DatePicker::make('survey_date')
                    ->required(),
                Select::make('condition')
                    ->options([
                        'good' => 'Good',
                        'minor_damage' => 'Minor Damage',
                        'moderate_damage' => 'Moderate Damage',
                        'severe_damage' => 'Severe Damage',
                    ])
                    ->required(),
                Textarea::make('findings')
                    ->columnSpanFull(),
                Textarea::make('recommendation')
                    ->columnSpanFull(),
                Toggle::make('is_urgent')
                    ->default(false),
                Select::make('responded_by')
                    ->relationship('responder', 'name'),
                Textarea::make('response_notes')
                    ->columnSpanFull(),
            ]);
    }
}
