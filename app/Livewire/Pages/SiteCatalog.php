<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HeritageSite;
use App\Models\SiteCategory;

class SiteCatalog extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $status = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'status' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategory()
    {
        $this->resetPage();
    }
    
    public function updatingStatus()
    {
        $this->resetPage();
    }
    
    public function updatingSort()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category', 'status', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $query = HeritageSite::with(['category', 'photos']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            // Find by slug or ID
            $categoryModel = SiteCategory::where(function($q) {
                $q->where('slug', $this->category);
                if (is_numeric($this->category)) {
                    $q->orWhere('id', $this->category);
                }
            })->first();
            if ($categoryModel) {
                $query->where('site_category_id', $categoryModel->id);
            }
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->sort === 'latest') {
            $query->latest();
        } elseif ($this->sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sort === 'name_desc') {
            $query->orderBy('name', 'desc');
        }

        $sites = $query->paginate(9);
        $categories = SiteCategory::all();

        return view('livewire.pages.site-catalog', compact('sites', 'categories'));
    }
}
