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
                'findings' => ['id' => 'Terdapat lumut di beberapa batuan candi perwara', 'en' => 'There is moss on some stones of the pervara temples'],
                'recommendation' => ['id' => 'Pembersihan mekanis secara berkala', 'en' => 'Regular mechanical cleaning'],
                'is_urgent' => false,
                'responded_by' => 4, // Agus Leader
                'responded_at' => now(),
                'response_notes' => ['id' => 'Jadwalkan pembersihan minggu depan', 'en' => 'Schedule cleaning for next week'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($reports as $report) {
            SiteConditionReport::updateOrCreate(
                [
                    'heritage_site_id' => $report['heritage_site_id'],
                    'survey_date' => $report['survey_date'],
                ],
                $report
            );
        }
    }
}
