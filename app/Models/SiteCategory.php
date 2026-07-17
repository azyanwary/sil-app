<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the heritage sites for this category.
     */
    public function heritageSites(): HasMany
    {
        return $this->hasMany(HeritageSite::class);
    }
}
