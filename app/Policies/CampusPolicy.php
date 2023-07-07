<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Campus;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the campus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list campuses');
    }

    /**
     * Determine whether the campus can view the model.
     */
    public function view(User $user, Campus $model): bool
    {
        return $user->hasPermissionTo('view campuses');
    }

    /**
     * Determine whether the campus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create campuses');
    }

    /**
     * Determine whether the campus can update the model.
     */
    public function update(User $user, Campus $model): bool
    {
        return $user->hasPermissionTo('update campuses');
    }

    /**
     * Determine whether the campus can delete the model.
     */
    public function delete(User $user, Campus $model): bool
    {
        return $user->hasPermissionTo('delete campuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete campuses');
    }

    /**
     * Determine whether the campus can restore the model.
     */
    public function restore(User $user, Campus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the campus can permanently delete the model.
     */
    public function forceDelete(User $user, Campus $model): bool
    {
        return false;
    }
}
