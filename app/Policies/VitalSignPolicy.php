<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VitalSign;
use Illuminate\Auth\Access\HandlesAuthorization;

class VitalSignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the vitalSign can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list vitalsigns');
    }

    /**
     * Determine whether the vitalSign can view the model.
     */
    public function view(User $user, VitalSign $model): bool
    {
        return $user->hasPermissionTo('view vitalsigns');
    }

    /**
     * Determine whether the vitalSign can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create vitalsigns');
    }

    /**
     * Determine whether the vitalSign can update the model.
     */
    public function update(User $user, VitalSign $model): bool
    {
        return $user->hasPermissionTo('update vitalsigns');
    }

    /**
     * Determine whether the vitalSign can delete the model.
     */
    public function delete(User $user, VitalSign $model): bool
    {
        return $user->hasPermissionTo('delete vitalsigns');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete vitalsigns');
    }

    /**
     * Determine whether the vitalSign can restore the model.
     */
    public function restore(User $user, VitalSign $model): bool
    {
        return false;
    }

    /**
     * Determine whether the vitalSign can permanently delete the model.
     */
    public function forceDelete(User $user, VitalSign $model): bool
    {
        return false;
    }
}
