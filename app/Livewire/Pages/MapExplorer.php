<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\HeritageSite;
use App\Models\SiteCategory;

class MapExplorer extends Component
{
    public $category = '';
    
    protected $queryString = [
        'category' => ['except' => ''],
    ];

    public function updatedCategory()
    {
        // Category changed, dispatch event
        $this->dispatch('map-updated', ['sitesJson' => $this->getSitesJson()]);
    }

    private function getSitesJson()
    {
        $query = HeritageSite::with(['category', 'photos'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
            
        if ($this->category) {
            $query->where('category_id', $this->category);
        }
        
        return $query->get()->map(function($site) {
            $photoUrl = null;
            if ($site->photos->count() > 0) {
                $featured = $site->photos->where('is_featured', true)->first() ?? $site->photos->first();
                if ($featured) {
                    $photoUrl = \Illuminate\Support\Facades\Storage::url($featured->photo_path);
                }
            }
            
            return [
                'id' => $site->id,
                'name' => $site->name,
                'slug' => $site->slug,
                'latitude' => $site->latitude,
                'longitude' => $site->longitude,
                'address' => $site->address,
                'category' => $site->category ? $site->category->name : 'Uncategorized',
                'status' => $site->status,
                'photo' => $photoUrl,
                'url' => route('sites.show', $site->slug ?? $site->id)
            ];
        })->toJson();
    }

    public function render()
    {
        $categories = SiteCategory::all();
        
        return view('livewire.pages.map-explorer', [
            'categories' => $categories,
            'sitesJson' => $this->getSitesJson()
        ])->layoutData(['title' => 'Peta Interaktif | Sistem Informasi Layanan BPK DIY']);
    }
}
