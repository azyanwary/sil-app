<?php

namespace App\Policies;

use App\Models\HeritageSite;
use App\Models\User;
use App\Enums\PermissionType;

class HeritageSitePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function view(User $user, HeritageSite $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function update(User $user, HeritageSite $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function delete(User $user, HeritageSite $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function restore(User $user, HeritageSite $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }

    public function forceDelete(User $user, HeritageSite $model): bool
    {
        return $user->can(PermissionType::MANAGE_HERITAGE_SITES->value);
    }
}
