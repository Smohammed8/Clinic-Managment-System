<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LabCatagory;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabCatagoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the labCatagory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list labcatagories');
    }

    /**
     * Determine whether the labCatagory can view the model.
     */
    public function view(User $user, LabCatagory $model): bool
    {
        return $user->hasPermissionTo('view labcatagories');
    }

    /**
     * Determine whether the labCatagory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create labcatagories');
    }

    /**
     * Determine whether the labCatagory can update the model.
     */
    public function update(User $user, LabCatagory $model): bool
    {
        return $user->hasPermissionTo('update labcatagories');
    }

    /**
     * Determine whether the labCatagory can delete the model.
     */
    public function delete(User $user, LabCatagory $model): bool
    {
        return $user->hasPermissionTo('delete labcatagories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete labcatagories');
    }

    /**
     * Determine whether the labCatagory can restore the model.
     */
    public function restore(User $user, LabCatagory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the labCatagory can permanently delete the model.
     */
    public function forceDelete(User $user, LabCatagory $model): bool
    {
        return false;
    }
}
