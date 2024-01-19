<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\View\View;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ConversationStoreRequest;
use App\Http\Requests\ConversationUpdateRequest;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Conversation::class);

        $search = $request->get('search', '');

        $conversations = Conversation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.conversations.index',
            compact('conversations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Conversation::class);

        $channels = Channel::pluck('name', 'id');

        return view('app.conversations.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConversationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Conversation::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $conversation = Conversation::create($validated);

        return redirect()
            ->route('conversations.edit', $conversation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Conversation $conversation): View
    {
        $this->authorize('view', $conversation);

        $conversations = Conversation::get()->all();

        $chats = $conversation->chats()->latest()->get();

        //reverse the order of the chats
        $chats = $chats->reverse();

        return view('app.conversations.show', compact('conversation', 'conversations', 'chats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Conversation $conversation): View
    {
        $this->authorize('update', $conversation);

        $channels = Channel::pluck('name', 'id');

        return view(
            'app.conversations.edit',
            compact('conversation', 'channels')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ConversationUpdateRequest $request,
        Conversation $conversation
    ): RedirectResponse {
        $this->authorize('update', $conversation);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($conversation->image) {
                Storage::delete($conversation->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $conversation->update($validated);

        return redirect()
            ->route('conversations.edit', $conversation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {
        $this->authorize('delete', $conversation);

        if ($conversation->image) {
            Storage::delete($conversation->image);
        }

        $conversation->delete();

        return redirect()
            ->route('conversations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
