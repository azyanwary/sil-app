<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SitePhoto extends Model
{
    protected $fillable = [
        'heritage_site_id',
        'file_path',
        'caption',
        'sort_order',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(HeritageSite::class, 'heritage_site_id');
    }
}
