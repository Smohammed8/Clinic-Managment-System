<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Prescription;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrescriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the prescription can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list prescriptions');
    }

    /**
     * Determine whether the prescription can view the model.
     */
    public function view(User $user, Prescription $model): bool
    {
        return $user->hasPermissionTo('view prescriptions');
    }

    /**
     * Determine whether the prescription can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create prescriptions');
    }

    /**
     * Determine whether the prescription can update the model.
     */
    public function update(User $user, Prescription $model): bool
    {
        return $user->hasPermissionTo('update prescriptions');
    }

    /**
     * Determine whether the prescription can delete the model.
     */
    public function delete(User $user, Prescription $model): bool
    {
        return $user->hasPermissionTo('delete prescriptions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete prescriptions');
    }

    /**
     * Determine whether the prescription can restore the model.
     */
    public function restore(User $user, Prescription $model): bool
    {
        return false;
    }

    /**
     * Determine whether the prescription can permanently delete the model.
     */
    public function forceDelete(User $user, Prescription $model): bool
    {
        return false;
    }
}
