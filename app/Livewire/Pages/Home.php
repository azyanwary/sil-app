<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\HeritageSite;
use App\Models\SiteCategory;
use App\Models\FacilityUsageRequest;

class Home extends Component
{
    public function render()
    {
        $totalSites = HeritageSite::count();
        $totalCategories = SiteCategory::count();
        $totalApprovedRequests = FacilityUsageRequest::where('status', 'disetujui')->count();
        
        $categories = SiteCategory::withCount('heritageSites')->get();
        
        $featuredSites = HeritageSite::with(['category', 'photos'])
            ->whereHas('photos', function($q) {
                $q->where('is_featured', true);
            })
            ->latest()
            ->take(6)
            ->get();
            
        // Fallback if no featured photos
        if ($featuredSites->isEmpty()) {
            $featuredSites = HeritageSite::with(['category', 'photos'])
                ->latest()
                ->take(6)
                ->get();
        }

        return view('livewire.pages.home', compact(
            'totalSites',
            'totalCategories',
            'totalApprovedRequests',
            'categories',
            'featuredSites'
        ));
    }
}
