<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConditionReportPhoto;

class ConditionReportPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            [
                'site_condition_report_id' => 1,
                'file_path' => 'reports/prambanan-lumut.jpg',
                'caption' => 'Foto lumut di batuan candi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        ConditionReportPhoto::insert($photos);
    }
}
