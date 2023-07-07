<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MainDiagnosis;
use Illuminate\Auth\Access\HandlesAuthorization;

class MainDiagnosisPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the mainDiagnosis can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list maindiagnoses');
    }

    /**
     * Determine whether the mainDiagnosis can view the model.
     */
    public function view(User $user, MainDiagnosis $model): bool
    {
        return $user->hasPermissionTo('view maindiagnoses');
    }

    /**
     * Determine whether the mainDiagnosis can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create maindiagnoses');
    }

    /**
     * Determine whether the mainDiagnosis can update the model.
     */
    public function update(User $user, MainDiagnosis $model): bool
    {
        return $user->hasPermissionTo('update maindiagnoses');
    }

    /**
     * Determine whether the mainDiagnosis can delete the model.
     */
    public function delete(User $user, MainDiagnosis $model): bool
    {
        return $user->hasPermissionTo('delete maindiagnoses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete maindiagnoses');
    }

    /**
     * Determine whether the mainDiagnosis can restore the model.
     */
    public function restore(User $user, MainDiagnosis $model): bool
    {
        return false;
    }

    /**
     * Determine whether the mainDiagnosis can permanently delete the model.
     */
    public function forceDelete(User $user, MainDiagnosis $model): bool
    {
        return false;
    }
}
