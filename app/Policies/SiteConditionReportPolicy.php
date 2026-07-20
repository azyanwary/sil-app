<?php

namespace App\Policies;

use App\Models\SiteConditionReport;
use App\Models\User;
use App\Enums\PermissionType;

class SiteConditionReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function view(User $user, SiteConditionReport $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function update(User $user, SiteConditionReport $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function delete(User $user, SiteConditionReport $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function restore(User $user, SiteConditionReport $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }

    public function forceDelete(User $user, SiteConditionReport $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CONDITION_REPORTS->value);
    }
}
