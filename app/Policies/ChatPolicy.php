<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the chat can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list chats');
    }

    /**
     * Determine whether the chat can view the model.
     */
    public function view(User $user, Chat $model): bool
    {
        return $user->hasPermissionTo('view chats');
    }

    /**
     * Determine whether the chat can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create chats');
    }

    /**
     * Determine whether the chat can update the model.
     */
    public function update(User $user, Chat $model): bool
    {
        return $user->hasPermissionTo('update chats');
    }

    /**
     * Determine whether the chat can delete the model.
     */
    public function delete(User $user, Chat $model): bool
    {
        return $user->hasPermissionTo('delete chats');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete chats');
    }

    /**
     * Determine whether the chat can restore the model.
     */
    public function restore(User $user, Chat $model): bool
    {
        return false;
    }

    /**
     * Determine whether the chat can permanently delete the model.
     */
    public function forceDelete(User $user, Chat $model): bool
    {
        return false;
    }
}
