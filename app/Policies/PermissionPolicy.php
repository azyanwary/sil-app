<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use App\Enums\PermissionType;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function view(User $user, Permission $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function update(User $user, Permission $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function delete(User $user, Permission $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function restore(User $user, Permission $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function forceDelete(User $user, Permission $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }
}
