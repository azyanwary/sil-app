<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteCategory;
use Illuminate\Support\Str;

class SiteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Candi',
                'slug' => Str::slug('Candi'),
                'description' => 'Bangunan purbakala yang berasal dari zaman Hindu-Buddha.',
                'icon' => 'candi-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keraton',
                'slug' => Str::slug('Keraton'),
                'description' => 'Istana tempat kediaman raja atau ratu beserta keluarganya.',
                'icon' => 'keraton-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Masjid Kuno',
                'slug' => Str::slug('Masjid Kuno'),
                'description' => 'Tempat ibadah peninggalan masa kerajaan Islam.',
                'icon' => 'masjid-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SiteCategory::insert($categories);
    }
}
