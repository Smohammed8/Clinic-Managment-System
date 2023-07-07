<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StockCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the stockCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list stockcategories');
    }

    /**
     * Determine whether the stockCategory can view the model.
     */
    public function view(User $user, StockCategory $model): bool
    {
        return $user->hasPermissionTo('view stockcategories');
    }

    /**
     * Determine whether the stockCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create stockcategories');
    }

    /**
     * Determine whether the stockCategory can update the model.
     */
    public function update(User $user, StockCategory $model): bool
    {
        return $user->hasPermissionTo('update stockcategories');
    }

    /**
     * Determine whether the stockCategory can delete the model.
     */
    public function delete(User $user, StockCategory $model): bool
    {
        return $user->hasPermissionTo('delete stockcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete stockcategories');
    }

    /**
     * Determine whether the stockCategory can restore the model.
     */
    public function restore(User $user, StockCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the stockCategory can permanently delete the model.
     */
    public function forceDelete(User $user, StockCategory $model): bool
    {
        return false;
    }
}
