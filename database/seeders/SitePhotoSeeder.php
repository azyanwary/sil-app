<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePhoto;
use App\Models\HeritageSite;

class SitePhotoSeeder extends Seeder
{
    public function run(): void
    {
        $sites = HeritageSite::all();

        foreach ($sites as $site) {
            $numPhotos = rand(1, 6);
            
            for ($i = 1; $i <= $numPhotos; $i++) {
                $seed = 'site_' . $site->id . '_photo_' . $i;
                $photoData = [
                    'heritage_site_id' => $site->id,
                    'file_path' => "https://picsum.photos/seed/{$seed}/800/600",
                    'caption' => [
                        'id' => "Foto {$i} untuk " . $site->getTranslation('name', 'id'), 
                        'en' => "Photo {$i} for " . $site->getTranslation('name', 'en')
                    ],
                    'sort_order' => $i,
                    'is_featured' => $i === 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                SitePhoto::updateOrCreate(
                    [
                        'heritage_site_id' => $site->id,
                        'sort_order' => $i,
                    ],
                    $photoData
                );
            }
        }
    }
}
