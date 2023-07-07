<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Diagnosis;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosisPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the diagnosis can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list diagnoses');
    }

    /**
     * Determine whether the diagnosis can view the model.
     */
    public function view(User $user, Diagnosis $model): bool
    {
        return $user->hasPermissionTo('view diagnoses');
    }

    /**
     * Determine whether the diagnosis can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create diagnoses');
    }

    /**
     * Determine whether the diagnosis can update the model.
     */
    public function update(User $user, Diagnosis $model): bool
    {
        return $user->hasPermissionTo('update diagnoses');
    }

    /**
     * Determine whether the diagnosis can delete the model.
     */
    public function delete(User $user, Diagnosis $model): bool
    {
        return $user->hasPermissionTo('delete diagnoses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete diagnoses');
    }

    /**
     * Determine whether the diagnosis can restore the model.
     */
    public function restore(User $user, Diagnosis $model): bool
    {
        return false;
    }

    /**
     * Determine whether the diagnosis can permanently delete the model.
     */
    public function forceDelete(User $user, Diagnosis $model): bool
    {
        return false;
    }
}
