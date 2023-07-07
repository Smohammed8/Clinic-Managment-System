<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collage;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the collage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list collages');
    }

    /**
     * Determine whether the collage can view the model.
     */
    public function view(User $user, Collage $model): bool
    {
        return $user->hasPermissionTo('view collages');
    }

    /**
     * Determine whether the collage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create collages');
    }

    /**
     * Determine whether the collage can update the model.
     */
    public function update(User $user, Collage $model): bool
    {
        return $user->hasPermissionTo('update collages');
    }

    /**
     * Determine whether the collage can delete the model.
     */
    public function delete(User $user, Collage $model): bool
    {
        return $user->hasPermissionTo('delete collages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete collages');
    }

    /**
     * Determine whether the collage can restore the model.
     */
    public function restore(User $user, Collage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the collage can permanently delete the model.
     */
    public function forceDelete(User $user, Collage $model): bool
    {
        return false;
    }
}
