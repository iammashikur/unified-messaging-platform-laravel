<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Conversation;
use App\Models\UserConversation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationUserConversationsTest extends TestCase
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
    public function it_gets_conversation_user_conversations(): void
    {
        $conversation = Conversation::factory()->create();
        $userConversations = UserConversation::factory()
            ->count(2)
            ->create([
                'conversation_id' => $conversation->id,
            ]);

        $response = $this->getJson(
            route('api.conversations.user-conversations.index', $conversation)
        );

        $response->assertOk()->assertSee($userConversations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_conversation_user_conversations(): void
    {
        $conversation = Conversation::factory()->create();
        $data = UserConversation::factory()
            ->make([
                'conversation_id' => $conversation->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.conversations.user-conversations.store', $conversation),
            $data
        );

        unset($data['conversation_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('user_conversations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $userConversation = UserConversation::latest('id')->first();

        $this->assertEquals(
            $conversation->id,
            $userConversation->conversation_id
        );
    }
}
