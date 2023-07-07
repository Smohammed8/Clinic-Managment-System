<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LabTestRequestGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabTestRequestGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the labTestRequestGroup can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list labtestrequestgroups');
    }

    /**
     * Determine whether the labTestRequestGroup can view the model.
     */
    public function view(User $user, LabTestRequestGroup $model): bool
    {
        return $user->hasPermissionTo('view labtestrequestgroups');
    }

    /**
     * Determine whether the labTestRequestGroup can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create labtestrequestgroups');
    }

    /**
     * Determine whether the labTestRequestGroup can update the model.
     */
    public function update(User $user, LabTestRequestGroup $model): bool
    {
        return $user->hasPermissionTo('update labtestrequestgroups');
    }

    /**
     * Determine whether the labTestRequestGroup can delete the model.
     */
    public function delete(User $user, LabTestRequestGroup $model): bool
    {
        return $user->hasPermissionTo('delete labtestrequestgroups');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete labtestrequestgroups');
    }

    /**
     * Determine whether the labTestRequestGroup can restore the model.
     */
    public function restore(User $user, LabTestRequestGroup $model): bool
    {
        return false;
    }

    /**
     * Determine whether the labTestRequestGroup can permanently delete the model.
     */
    public function forceDelete(User $user, LabTestRequestGroup $model): bool
    {
        return false;
    }
}
