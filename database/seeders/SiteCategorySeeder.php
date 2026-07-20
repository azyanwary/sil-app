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
                'name' => json_encode(['id' => 'Candi', 'en' => 'Temple']),
                'slug' => Str::slug('Candi'),
                'description' => json_encode(['id' => 'Bangunan purbakala yang berasal dari zaman Hindu-Buddha.', 'en' => 'Ancient building originating from the Hindu-Buddhist era.']),
                'icon' => 'candi-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['id' => 'Keraton', 'en' => 'Palace']),
                'slug' => Str::slug('Keraton'),
                'description' => json_encode(['id' => 'Istana tempat kediaman raja atau ratu beserta keluarganya.', 'en' => 'Palace where the king or queen and their family reside.']),
                'icon' => 'keraton-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['id' => 'Masjid Kuno', 'en' => 'Ancient Mosque']),
                'slug' => Str::slug('Masjid Kuno'),
                'description' => json_encode(['id' => 'Tempat ibadah peninggalan masa kerajaan Islam.', 'en' => 'Place of worship inherited from the Islamic kingdom era.']),
                'icon' => 'masjid-icon.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SiteCategory::insert($categories);
    }
}
