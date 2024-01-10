<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ChatResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatCollection;

class UserChatsController extends Controller
{
    public function index(Request $request, User $user): ChatCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $chats = $user
            ->chats()
            ->search($search)
            ->latest()
            ->paginate();

        return new ChatCollection($chats);
    }

    public function store(Request $request, User $user): ChatResource
    {
        $this->authorize('create', Chat::class);

        $validated = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'status' => ['required', 'boolean'],
            'conversation_id' => ['required', 'exists:conversations,id'],
        ]);

        $chat = $user->chats()->create($validated);

        return new ChatResource($chat);
    }
}
