<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LabTest;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabTestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the labTest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list labtests');
    }

    /**
     * Determine whether the labTest can view the model.
     */
    public function view(User $user, LabTest $model): bool
    {
        return $user->hasPermissionTo('view labtests');
    }

    /**
     * Determine whether the labTest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create labtests');
    }

    /**
     * Determine whether the labTest can update the model.
     */
    public function update(User $user, LabTest $model): bool
    {
        return $user->hasPermissionTo('update labtests');
    }

    /**
     * Determine whether the labTest can delete the model.
     */
    public function delete(User $user, LabTest $model): bool
    {
        return $user->hasPermissionTo('delete labtests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete labtests');
    }

    /**
     * Determine whether the labTest can restore the model.
     */
    public function restore(User $user, LabTest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the labTest can permanently delete the model.
     */
    public function forceDelete(User $user, LabTest $model): bool
    {
        return false;
    }
}
