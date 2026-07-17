<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteConditionReport;

class SiteConditionReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [
                'heritage_site_id' => 1, // Prambanan
                'surveyor_id' => 2, // Budi Site Manager
                'survey_date' => '2026-07-10',
                'condition' => 'minor_damage',
                'findings' => 'Terdapat lumut di beberapa batuan candi perwara',
                'recommendation' => 'Pembersihan mekanis secara berkala',
                'is_urgent' => false,
                'responded_by' => 4, // Agus Leader
                'responded_at' => now(),
                'response_notes' => 'Jadwalkan pembersihan minggu depan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SiteConditionReport::insert($reports);
    }
}
