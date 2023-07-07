<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClinicUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClinicUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clinicUser can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list clinicusers');
    }

    /**
     * Determine whether the clinicUser can view the model.
     */
    public function view(User $user, ClinicUser $model): bool
    {
        return $user->hasPermissionTo('view clinicusers');
    }

    /**
     * Determine whether the clinicUser can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create clinicusers');
    }

    /**
     * Determine whether the clinicUser can update the model.
     */
    public function update(User $user, ClinicUser $model): bool
    {
        return $user->hasPermissionTo('update clinicusers');
    }

    /**
     * Determine whether the clinicUser can delete the model.
     */
    public function delete(User $user, ClinicUser $model): bool
    {
        return $user->hasPermissionTo('delete clinicusers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete clinicusers');
    }

    /**
     * Determine whether the clinicUser can restore the model.
     */
    public function restore(User $user, ClinicUser $model): bool
    {
        return false;
    }

    /**
     * Determine whether the clinicUser can permanently delete the model.
     */
    public function forceDelete(User $user, ClinicUser $model): bool
    {
        return false;
    }
}
