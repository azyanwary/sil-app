<?php

namespace App\Policies;

use App\Models\User;

use App\Enums\PermissionType;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function restore(User $user, User $model): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->can(PermissionType::MANAGE_USERS->value);
    }
}
