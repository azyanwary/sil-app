<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function heritageSites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeritageSite::class, 'created_by');
    }

    public function facilityUsageRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FacilityUsageRequest::class, 'user_id');
    }

    public function reviewedUsageRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FacilityUsageRequest::class, 'reviewed_by');
    }

    public function surveyedConditionReports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SiteConditionReport::class, 'surveyor_id');
    }

    public function respondedConditionReports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SiteConditionReport::class, 'responded_by');
    }
}
