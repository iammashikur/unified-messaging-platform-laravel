<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the conversation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list conversations');
    }

    /**
     * Determine whether the conversation can view the model.
     */
    public function view(User $user, Conversation $model): bool
    {
        return $user->hasPermissionTo('view conversations');
    }

    /**
     * Determine whether the conversation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create conversations');
    }

    /**
     * Determine whether the conversation can update the model.
     */
    public function update(User $user, Conversation $model): bool
    {
        return $user->hasPermissionTo('update conversations');
    }

    /**
     * Determine whether the conversation can delete the model.
     */
    public function delete(User $user, Conversation $model): bool
    {
        return $user->hasPermissionTo('delete conversations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete conversations');
    }

    /**
     * Determine whether the conversation can restore the model.
     */
    public function restore(User $user, Conversation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the conversation can permanently delete the model.
     */
    public function forceDelete(User $user, Conversation $model): bool
    {
        return false;
    }
}
