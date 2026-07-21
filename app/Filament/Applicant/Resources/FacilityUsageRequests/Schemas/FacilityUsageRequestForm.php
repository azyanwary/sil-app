<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FacilityUsageRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('heritage_site_id')
                    ->label('Situs Cagar Budaya')
                    ->relationship('heritageSite', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('activity_type')
                    ->label('Jenis Kegiatan')
                    ->required()
                    ->maxLength(255),
                Textarea::make('activity_description')
                    ->label('Deskripsi Kegiatan')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->afterOrEqual('start_date'),
                TextInput::make('duration_days')
                    ->label('Lama Kegiatan (Hari)')
                    ->numeric()
                    ->required()
                    ->minValue(1),
                TextInput::make('participant_count')
                    ->label('Jumlah Peserta')
                    ->numeric()
                    ->required()
                    ->minValue(1),
                \Filament\Forms\Components\FileUpload::make('application_letter_path')
                    ->label('Surat Permohonan')
                    ->required()
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(5120)
                    ->directory('application-letters')
                    ->columnSpanFull(),
            ]);
    }
}
