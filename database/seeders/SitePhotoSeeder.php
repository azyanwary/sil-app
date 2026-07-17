<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePhoto;

class SitePhotoSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            [
                'heritage_site_id' => 1,
                'file_path' => 'photos/prambanan-1.jpg',
                'caption' => 'Tampak depan Candi Prambanan',
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heritage_site_id' => 2,
                'file_path' => 'photos/keraton-1.jpg',
                'caption' => 'Pelataran Keraton Yogyakarta',
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heritage_site_id' => 3,
                'file_path' => 'photos/masjid-kauman-1.jpg',
                'caption' => 'Serambi Masjid Gedhe Kauman',
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SitePhoto::insert($photos);
    }
}
