<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the appointment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list appointments');
    }

    /**
     * Determine whether the appointment can view the model.
     */
    public function view(User $user, Appointment $model): bool
    {
        return $user->hasPermissionTo('view appointments');
    }

    /**
     * Determine whether the appointment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create appointments');
    }

    /**
     * Determine whether the appointment can update the model.
     */
    public function update(User $user, Appointment $model): bool
    {
        return $user->hasPermissionTo('update appointments');
    }

    /**
     * Determine whether the appointment can delete the model.
     */
    public function delete(User $user, Appointment $model): bool
    {
        return $user->hasPermissionTo('delete appointments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete appointments');
    }

    /**
     * Determine whether the appointment can restore the model.
     */
    public function restore(User $user, Appointment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the appointment can permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $model): bool
    {
        return false;
    }
}
