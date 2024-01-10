<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserConversation;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserConversationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userConversation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list userconversations');
    }

    /**
     * Determine whether the userConversation can view the model.
     */
    public function view(User $user, UserConversation $model): bool
    {
        return $user->hasPermissionTo('view userconversations');
    }

    /**
     * Determine whether the userConversation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create userconversations');
    }

    /**
     * Determine whether the userConversation can update the model.
     */
    public function update(User $user, UserConversation $model): bool
    {
        return $user->hasPermissionTo('update userconversations');
    }

    /**
     * Determine whether the userConversation can delete the model.
     */
    public function delete(User $user, UserConversation $model): bool
    {
        return $user->hasPermissionTo('delete userconversations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete userconversations');
    }

    /**
     * Determine whether the userConversation can restore the model.
     */
    public function restore(User $user, UserConversation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the userConversation can permanently delete the model.
     */
    public function forceDelete(User $user, UserConversation $model): bool
    {
        return false;
    }
}
