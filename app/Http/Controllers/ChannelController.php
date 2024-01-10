<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ChannelStoreRequest;
use App\Http\Requests\ChannelUpdateRequest;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Channel::class);

        $search = $request->get('search', '');

        $channels = Channel::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.channels.index', compact('channels', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Channel::class);

        return view('app.channels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChannelStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Channel::class);

        $validated = $request->validated();
        $validated['configuration'] = json_decode(
            $validated['configuration'],
            true
        );

        $channel = Channel::create($validated);

        return redirect()
            ->route('channels.edit', $channel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Channel $channel): View
    {
        $this->authorize('view', $channel);

        return view('app.channels.show', compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Channel $channel): View
    {
        $this->authorize('update', $channel);

        return view('app.channels.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ChannelUpdateRequest $request,
        Channel $channel
    ): RedirectResponse {
        $this->authorize('update', $channel);

        $validated = $request->validated();
        $validated['configuration'] = json_decode(
            $validated['configuration'],
            true
        );

        $channel->update($validated);

        return redirect()
            ->route('channels.edit', $channel)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Channel $channel
    ): RedirectResponse {
        $this->authorize('delete', $channel);

        $channel->delete();

        return redirect()
            ->route('channels.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
