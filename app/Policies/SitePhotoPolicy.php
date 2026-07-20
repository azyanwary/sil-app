<?php

namespace App\Policies;

use App\Models\SitePhoto;
use App\Models\User;
use App\Enums\PermissionType;

class SitePhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function view(User $user, SitePhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function update(User $user, SitePhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function delete(User $user, SitePhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function restore(User $user, SitePhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function forceDelete(User $user, SitePhoto $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }
}
