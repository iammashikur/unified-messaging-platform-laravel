<?php

namespace App\Http\Controllers\Api;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\ChannelCollection;
use App\Http\Requests\ChannelStoreRequest;
use App\Http\Requests\ChannelUpdateRequest;

class ChannelController extends Controller
{
    public function index(Request $request): ChannelCollection
    {
        $this->authorize('view-any', Channel::class);

        $search = $request->get('search', '');

        $channels = Channel::search($search)
            ->latest()
            ->paginate();

        return new ChannelCollection($channels);
    }

    public function store(ChannelStoreRequest $request): ChannelResource
    {
        $this->authorize('create', Channel::class);

        $validated = $request->validated();
        $validated['configuration'] = json_decode(
            $validated['configuration'],
            true
        );

        $channel = Channel::create($validated);

        return new ChannelResource($channel);
    }

    public function show(Request $request, Channel $channel): ChannelResource
    {
        $this->authorize('view', $channel);

        return new ChannelResource($channel);
    }

    public function update(
        ChannelUpdateRequest $request,
        Channel $channel
    ): ChannelResource {
        $this->authorize('update', $channel);

        $validated = $request->validated();

        $validated['configuration'] = json_decode(
            $validated['configuration'],
            true
        );

        $channel->update($validated);

        return new ChannelResource($channel);
    }

    public function destroy(Request $request, Channel $channel): Response
    {
        $this->authorize('delete', $channel);

        $channel->delete();

        return response()->noContent();
    }
}
