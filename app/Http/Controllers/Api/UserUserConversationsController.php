<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserConversationResource;
use App\Http\Resources\UserConversationCollection;

class UserUserConversationsController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): UserConversationCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $userConversations = $user
            ->userConversations()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserConversationCollection($userConversations);
    }

    public function store(
        Request $request,
        User $user
    ): UserConversationResource {
        $this->authorize('create', UserConversation::class);

        $validated = $request->validate([
            'conversation_id' => ['required', 'exists:conversations,id'],
        ]);

        $userConversation = $user->userConversations()->create($validated);

        return new UserConversationResource($userConversation);
    }
}
