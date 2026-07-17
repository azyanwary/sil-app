<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConditionReportPhoto extends Model
{
    protected $fillable = [
        'site_condition_report_id',
        'file_path',
        'caption',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(SiteConditionReport::class, 'site_condition_report_id');
    }
}
