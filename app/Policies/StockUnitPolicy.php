<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StockUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the stockUnit can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list stockunits');
    }

    /**
     * Determine whether the stockUnit can view the model.
     */
    public function view(User $user, StockUnit $model): bool
    {
        return $user->hasPermissionTo('view stockunits');
    }

    /**
     * Determine whether the stockUnit can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create stockunits');
    }

    /**
     * Determine whether the stockUnit can update the model.
     */
    public function update(User $user, StockUnit $model): bool
    {
        return $user->hasPermissionTo('update stockunits');
    }

    /**
     * Determine whether the stockUnit can delete the model.
     */
    public function delete(User $user, StockUnit $model): bool
    {
        return $user->hasPermissionTo('delete stockunits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete stockunits');
    }

    /**
     * Determine whether the stockUnit can restore the model.
     */
    public function restore(User $user, StockUnit $model): bool
    {
        return false;
    }

    /**
     * Determine whether the stockUnit can permanently delete the model.
     */
    public function forceDelete(User $user, StockUnit $model): bool
    {
        return false;
    }
}
