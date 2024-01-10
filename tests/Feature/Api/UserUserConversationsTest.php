<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserConversation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUserConversationsTest extends TestCase
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
    public function it_gets_user_user_conversations(): void
    {
        $user = User::factory()->create();
        $userConversations = UserConversation::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.user-conversations.index', $user)
        );

        $response->assertOk()->assertSee($userConversations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_user_conversations(): void
    {
        $user = User::factory()->create();
        $data = UserConversation::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.user-conversations.store', $user),
            $data
        );

        unset($data['conversation_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('user_conversations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $userConversation = UserConversation::latest('id')->first();

        $this->assertEquals($user->id, $userConversation->user_id);
    }
}
