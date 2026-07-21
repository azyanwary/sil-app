<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\HeritageSite;

class SiteDetail extends Component
{
    public $site;

    public function mount($slugOrId)
    {
        $this->site = HeritageSite::with(['category', 'photos'])
                        ->where(function ($query) use ($slugOrId) {
                            $query->where('slug', $slugOrId);
                            if (is_numeric($slugOrId)) {
                                $query->orWhere('id', $slugOrId);
                            }
                        })
                        ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.site-detail')
            ->layoutData(['title' => $this->site->name . ' | Sistem Informasi Layanan BPK DIY']);
    }
}
