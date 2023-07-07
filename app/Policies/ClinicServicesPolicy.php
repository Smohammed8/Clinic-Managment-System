<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClinicServices;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClinicServicesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clinicServices can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allclinicservices');
    }

    /**
     * Determine whether the clinicServices can view the model.
     */
    public function view(User $user, ClinicServices $model): bool
    {
        return $user->hasPermissionTo('view allclinicservices');
    }

    /**
     * Determine whether the clinicServices can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allclinicservices');
    }

    /**
     * Determine whether the clinicServices can update the model.
     */
    public function update(User $user, ClinicServices $model): bool
    {
        return $user->hasPermissionTo('update allclinicservices');
    }

    /**
     * Determine whether the clinicServices can delete the model.
     */
    public function delete(User $user, ClinicServices $model): bool
    {
        return $user->hasPermissionTo('delete allclinicservices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allclinicservices');
    }

    /**
     * Determine whether the clinicServices can restore the model.
     */
    public function restore(User $user, ClinicServices $model): bool
    {
        return false;
    }

    /**
     * Determine whether the clinicServices can permanently delete the model.
     */
    public function forceDelete(User $user, ClinicServices $model): bool
    {
        return false;
    }
}
