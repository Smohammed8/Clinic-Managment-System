<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicalRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the medicalRecord can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list medicalrecords');
    }

    /**
     * Determine whether the medicalRecord can view the model.
     */
    public function view(User $user, MedicalRecord $model): bool
    {
        return $user->hasPermissionTo('view medicalrecords');
    }

    /**
     * Determine whether the medicalRecord can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create medicalrecords');
    }

    /**
     * Determine whether the medicalRecord can update the model.
     */
    public function update(User $user, MedicalRecord $model): bool
    {
        return $user->hasPermissionTo('update medicalrecords');
    }

    /**
     * Determine whether the medicalRecord can delete the model.
     */
    public function delete(User $user, MedicalRecord $model): bool
    {
        return $user->hasPermissionTo('delete medicalrecords');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete medicalrecords');
    }

    /**
     * Determine whether the medicalRecord can restore the model.
     */
    public function restore(User $user, MedicalRecord $model): bool
    {
        return false;
    }

    /**
     * Determine whether the medicalRecord can permanently delete the model.
     */
    public function forceDelete(User $user, MedicalRecord $model): bool
    {
        return false;
    }
}
