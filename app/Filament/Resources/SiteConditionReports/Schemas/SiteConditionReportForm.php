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
                    ->label(__('Site'))
                    ->relationship('site', 'name')
                    ->required(),
                Select::make('surveyor_id')
                    ->label(__('Surveyor'))
                    ->relationship('surveyor', 'name')
                    ->required(),
                DatePicker::make('survey_date')
                    ->label(__('Survey Date'))
                    ->required(),
                Select::make('condition')
                    ->label(__('Condition'))
                    ->options([
                        'good' => __('Good'),
                        'minor_damage' => __('Minor Damage'),
                        'moderate_damage' => __('Moderate Damage'),
                        'severe_damage' => __('Severe Damage'),
                    ])
                    ->required(),
                Textarea::make('findings')
                    ->label(__('Findings'))
                    ->columnSpanFull(),
                Textarea::make('recommendation')
                    ->label(__('Recommendation'))
                    ->columnSpanFull(),
                Toggle::make('is_urgent')
                    ->label(__('Urgent'))
                    ->default(false),
                Select::make('responded_by')
                    ->label(__('Responded by'))
                    ->relationship('responder', 'name'),
                Textarea::make('response_notes')
                    ->label(__('Response Notes'))
                    ->columnSpanFull(),
            ]);
    }
}
