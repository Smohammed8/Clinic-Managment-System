<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LabTestRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabTestRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the labTestRequest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list labtestrequests');
    }

    /**
     * Determine whether the labTestRequest can view the model.
     */
    public function view(User $user, LabTestRequest $model): bool
    {
        return $user->hasPermissionTo('view labtestrequests');
    }

    /**
     * Determine whether the labTestRequest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create labtestrequests');
    }

    /**
     * Determine whether the labTestRequest can update the model.
     */
    public function update(User $user, LabTestRequest $model): bool
    {
        return $user->hasPermissionTo('update labtestrequests');
    }

    /**
     * Determine whether the labTestRequest can delete the model.
     */
    public function delete(User $user, LabTestRequest $model): bool
    {
        return $user->hasPermissionTo('delete labtestrequests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete labtestrequests');
    }

    /**
     * Determine whether the labTestRequest can restore the model.
     */
    public function restore(User $user, LabTestRequest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the labTestRequest can permanently delete the model.
     */
    public function forceDelete(User $user, LabTestRequest $model): bool
    {
        return false;
    }
}
