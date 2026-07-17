<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteConditionReport extends Model
{
    protected $fillable = [
        'heritage_site_id',
        'surveyor_id',
        'survey_date',
        'condition',
        'findings',
        'recommendation',
        'is_urgent',
        'responded_by',
        'responded_at',
        'response_notes',
    ];

    protected function casts(): array
    {
        return [
            'survey_date' => 'date',
            'is_urgent' => 'boolean',
            'responded_at' => 'datetime',
        ];
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(HeritageSite::class, 'heritage_site_id');
    }

    public function surveyor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'surveyor_id');
    }

    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ConditionReportPhoto::class);
    }
}
