<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Channel;
use App\Models\Conversation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelConversationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_channel_conversations(): void
    {
        $channel = Channel::factory()->create();
        $conversations = Conversation::factory()
            ->count(2)
            ->create([
                'channel_id' => $channel->id,
            ]);

        $response = $this->getJson(
            route('api.channels.conversations.index', $channel)
        );

        $response->assertOk()->assertSee($conversations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_channel_conversations(): void
    {
        $channel = Channel::factory()->create();
        $data = Conversation::factory()
            ->make([
                'channel_id' => $channel->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.channels.conversations.store', $channel),
            $data
        );

        $this->assertDatabaseHas('conversations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $conversation = Conversation::latest('id')->first();

        $this->assertEquals($channel->id, $conversation->channel_id);
    }
}
