<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Enums\PermissionType;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function view(User $user, Role $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function update(User $user, Role $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function delete(User $user, Role $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function restore(User $user, Role $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }

    public function forceDelete(User $user, Role $model): bool
    {
        return $user->can(PermissionType::MANAGE_ROLES->value);
    }
}
