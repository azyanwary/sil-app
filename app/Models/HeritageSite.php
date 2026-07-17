<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeritageSite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'site_category_id',
        'name',
        'slug',
        'description',
        'address',
        'latitude',
        'longitude',
        'operating_hours',
        'registration_number',
        'designation_year',
        'status',
        'is_facility_available',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'operating_hours' => 'array',
            'is_facility_available' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SiteCategory::class, 'site_category_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(SitePhoto::class);
    }

    public function facilityUsageRequests(): HasMany
    {
        return $this->hasMany(FacilityUsageRequest::class);
    }

    public function conditionReports(): HasMany
    {
        return $this->hasMany(SiteConditionReport::class);
    }
}
