<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserConversationResource;
use App\Http\Resources\UserConversationCollection;

class ConversationUserConversationsController extends Controller
{
    public function index(
        Request $request,
        Conversation $conversation
    ): UserConversationCollection {
        $this->authorize('view', $conversation);

        $search = $request->get('search', '');

        $userConversations = $conversation
            ->userConversations()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserConversationCollection($userConversations);
    }

    public function store(
        Request $request,
        Conversation $conversation
    ): UserConversationResource {
        $this->authorize('create', UserConversation::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $userConversation = $conversation
            ->userConversations()
            ->create($validated);

        return new UserConversationResource($userConversation);
    }
}
