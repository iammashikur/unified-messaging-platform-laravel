<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Chat;
use App\Models\Conversation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationChatsTest extends TestCase
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
    public function it_gets_conversation_chats(): void
    {
        $conversation = Conversation::factory()->create();
        $chats = Chat::factory()
            ->count(2)
            ->create([
                'conversation_id' => $conversation->id,
            ]);

        $response = $this->getJson(
            route('api.conversations.chats.index', $conversation)
        );

        $response->assertOk()->assertSee($chats[0]->content);
    }

    /**
     * @test
     */
    public function it_stores_the_conversation_chats(): void
    {
        $conversation = Conversation::factory()->create();
        $data = Chat::factory()
            ->make([
                'conversation_id' => $conversation->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.conversations.chats.store', $conversation),
            $data
        );

        unset($data['content']);
        unset($data['status']);
        unset($data['conversation_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('chats', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $chat = Chat::latest('id')->first();

        $this->assertEquals($conversation->id, $chat->conversation_id);
    }
}
