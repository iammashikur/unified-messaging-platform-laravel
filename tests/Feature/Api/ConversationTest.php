<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Conversation;

use App\Models\Channel;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationTest extends TestCase
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
    public function it_gets_conversations_list(): void
    {
        $conversations = Conversation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.conversations.index'));

        $response->assertOk()->assertSee($conversations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_conversation(): void
    {
        $data = Conversation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.conversations.store'), $data);

        $this->assertDatabaseHas('conversations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_conversation(): void
    {
        $conversation = Conversation::factory()->create();

        $channel = Channel::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'channel_id' => $channel->id,
        ];

        $response = $this->putJson(
            route('api.conversations.update', $conversation),
            $data
        );

        $data['id'] = $conversation->id;

        $this->assertDatabaseHas('conversations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_conversation(): void
    {
        $conversation = Conversation::factory()->create();

        $response = $this->deleteJson(
            route('api.conversations.destroy', $conversation)
        );

        $this->assertModelMissing($conversation);

        $response->assertNoContent();
    }
}
