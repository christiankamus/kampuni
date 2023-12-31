<?php

namespace App\Policies;


use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super-admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //return $user->hasAnyRole(['super-admin']);
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        //return $user->hasAnyRole(['super-admin']);
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        //return $user->hasAnyRole(['super-admin']);
        return false;
    }

}
