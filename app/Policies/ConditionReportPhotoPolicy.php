<?php

namespace App\Policies;

use App\Models\ConditionReportPhoto;
use App\Models\User;
use App\Enums\PermissionType;

class ConditionReportPhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function view(User $user, ConditionReportPhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function update(User $user, ConditionReportPhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function delete(User $user, ConditionReportPhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function restore(User $user, ConditionReportPhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function forceDelete(User $user, ConditionReportPhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }
}
