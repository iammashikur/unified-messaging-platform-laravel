<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the channel can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list channels');
    }

    /**
     * Determine whether the channel can view the model.
     */
    public function view(User $user, Channel $model): bool
    {
        return $user->hasPermissionTo('view channels');
    }

    /**
     * Determine whether the channel can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create channels');
    }

    /**
     * Determine whether the channel can update the model.
     */
    public function update(User $user, Channel $model): bool
    {
        return $user->hasPermissionTo('update channels');
    }

    /**
     * Determine whether the channel can delete the model.
     */
    public function delete(User $user, Channel $model): bool
    {
        return $user->hasPermissionTo('delete channels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete channels');
    }

    /**
     * Determine whether the channel can restore the model.
     */
    public function restore(User $user, Channel $model): bool
    {
        return false;
    }

    /**
     * Determine whether the channel can permanently delete the model.
     */
    public function forceDelete(User $user, Channel $model): bool
    {
        return false;
    }
}
