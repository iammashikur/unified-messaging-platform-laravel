<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Attachment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the attachment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list attachments');
    }

    /**
     * Determine whether the attachment can view the model.
     */
    public function view(User $user, Attachment $model): bool
    {
        return $user->hasPermissionTo('view attachments');
    }

    /**
     * Determine whether the attachment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create attachments');
    }

    /**
     * Determine whether the attachment can update the model.
     */
    public function update(User $user, Attachment $model): bool
    {
        return $user->hasPermissionTo('update attachments');
    }

    /**
     * Determine whether the attachment can delete the model.
     */
    public function delete(User $user, Attachment $model): bool
    {
        return $user->hasPermissionTo('delete attachments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete attachments');
    }

    /**
     * Determine whether the attachment can restore the model.
     */
    public function restore(User $user, Attachment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the attachment can permanently delete the model.
     */
    public function forceDelete(User $user, Attachment $model): bool
    {
        return false;
    }
}
