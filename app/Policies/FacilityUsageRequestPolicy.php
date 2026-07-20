<?php

namespace App\Policies;

use App\Models\FacilityUsageRequest;
use App\Models\User;
use App\Enums\PermissionType;

class FacilityUsageRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function view(User $user, FacilityUsageRequest $model): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function update(User $user, FacilityUsageRequest $model): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function delete(User $user, FacilityUsageRequest $model): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function restore(User $user, FacilityUsageRequest $model): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }

    public function forceDelete(User $user, FacilityUsageRequest $model): bool
    {
        return $user->can(PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value);
    }
}
