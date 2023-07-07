<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Encounter;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncounterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the encounter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list encounters');
    }

    /**
     * Determine whether the encounter can view the model.
     */
    public function view(User $user, Encounter $model): bool
    {
        return $user->hasPermissionTo('view encounters');
    }

    /**
     * Determine whether the encounter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create encounters');
    }

    /**
     * Determine whether the encounter can update the model.
     */
    public function update(User $user, Encounter $model): bool
    {
        return $user->hasPermissionTo('update encounters');
    }

    /**
     * Determine whether the encounter can delete the model.
     */
    public function delete(User $user, Encounter $model): bool
    {
        return $user->hasPermissionTo('delete encounters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete encounters');
    }

    /**
     * Determine whether the encounter can restore the model.
     */
    public function restore(User $user, Encounter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the encounter can permanently delete the model.
     */
    public function forceDelete(User $user, Encounter $model): bool
    {
        return false;
    }
}
