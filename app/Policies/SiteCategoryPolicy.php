<?php

namespace App\Policies;

use App\Models\SiteCategory;
use App\Models\User;
use App\Enums\PermissionType;

class SiteCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function view(User $user, SiteCategory $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function update(User $user, SiteCategory $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function delete(User $user, SiteCategory $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function restore(User $user, SiteCategory $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }

    public function forceDelete(User $user, SiteCategory $model): bool
    {
        return $user->can(PermissionType::MANAGE_SITE_CATEGORIES->value);
    }
}
