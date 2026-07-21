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
                'name' => ['id' => 'Candi', 'en' => 'Temple'],
                'slug' => Str::slug('Candi'),
                'description' => ['id' => 'Bangunan purbakala yang berasal dari zaman Hindu-Buddha.', 'en' => 'Ancient building originating from the Hindu-Buddhist era.'],
                'icon' => 'https://picsum.photos/id/1015/200/200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => ['id' => 'Keraton', 'en' => 'Palace'],
                'slug' => Str::slug('Keraton'),
                'description' => ['id' => 'Istana tempat kediaman raja atau ratu beserta keluarganya.', 'en' => 'Palace where the king or queen and their family reside.'],
                'icon' => 'https://picsum.photos/id/1025/200/200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => ['id' => 'Masjid Kuno', 'en' => 'Ancient Mosque'],
                'slug' => Str::slug('Masjid Kuno'),
                'description' => ['id' => 'Tempat ibadah peninggalan masa kerajaan Islam.', 'en' => 'Place of worship inherited from the Islamic kingdom era.'],
                'icon' => 'https://picsum.photos/id/1035/200/200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            SiteCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
