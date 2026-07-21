<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityUsageRequest extends Model
{
    use SoftDeletes;

    protected static function booted()
    {
        static::creating(function ($request) {
            if (empty($request->request_number)) {
                $request->request_number = 'REQ-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $fillable = [
        'request_number',
        'user_id',
        'applicant_id',
        'heritage_site_id',
        'applicant_name',
        'identity_number',
        'institution_name',
        'activity_type',
        'activity_description',
        'start_date',
        'end_date',
        'duration_days',
        'participant_count',
        'application_letter_path',
        'status',
        'approval_notes',
        'permit_number',
        'fee_amount',
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'duration_days' => 'integer',
            'participant_count' => 'integer',
            'fee_amount' => 'integer',
            'reviewed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(HeritageSite::class, 'heritage_site_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
