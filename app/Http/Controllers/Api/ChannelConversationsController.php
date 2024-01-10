<?php

namespace App\Http\Controllers\Api;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationCollection;

class ChannelConversationsController extends Controller
{
    public function index(
        Request $request,
        Channel $channel
    ): ConversationCollection {
        $this->authorize('view', $channel);

        $search = $request->get('search', '');

        $conversations = $channel
            ->conversations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ConversationCollection($conversations);
    }

    public function store(
        Request $request,
        Channel $channel
    ): ConversationResource {
        $this->authorize('create', Conversation::class);

        $validated = $request->validate([
            'name' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $conversation = $channel->conversations()->create($validated);

        return new ConversationResource($conversation);
    }
}
