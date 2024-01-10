<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationCollection;
use App\Http\Requests\ConversationStoreRequest;
use App\Http\Requests\ConversationUpdateRequest;

class ConversationController extends Controller
{
    public function index(Request $request): ConversationCollection
    {
        $this->authorize('view-any', Conversation::class);

        $search = $request->get('search', '');

        $conversations = Conversation::search($search)
            ->latest()
            ->paginate();

        return new ConversationCollection($conversations);
    }

    public function store(
        ConversationStoreRequest $request
    ): ConversationResource {
        $this->authorize('create', Conversation::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $conversation = Conversation::create($validated);

        return new ConversationResource($conversation);
    }

    public function show(
        Request $request,
        Conversation $conversation
    ): ConversationResource {
        $this->authorize('view', $conversation);

        return new ConversationResource($conversation);
    }

    public function update(
        ConversationUpdateRequest $request,
        Conversation $conversation
    ): ConversationResource {
        $this->authorize('update', $conversation);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($conversation->image) {
                Storage::delete($conversation->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $conversation->update($validated);

        return new ConversationResource($conversation);
    }

    public function destroy(
        Request $request,
        Conversation $conversation
    ): Response {
        $this->authorize('delete', $conversation);

        if ($conversation->image) {
            Storage::delete($conversation->image);
        }

        $conversation->delete();

        return response()->noContent();
    }
}
