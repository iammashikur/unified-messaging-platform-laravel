<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Resources\ChatResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatCollection;

class ConversationChatsController extends Controller
{
    public function index(
        Request $request,
        Conversation $conversation
    ): ChatCollection {
        $this->authorize('view', $conversation);

        $search = $request->get('search', '');

        $chats = $conversation
            ->chats()
            ->search($search)
            ->latest()
            ->paginate();

        return new ChatCollection($chats);
    }

    public function store(
        Request $request,
        Conversation $conversation
    ): ChatResource {
        $this->authorize('create', Chat::class);

        $validated = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'status' => ['required', 'boolean'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $chat = $conversation->chats()->create($validated);

        return new ChatResource($chat);
    }
}
