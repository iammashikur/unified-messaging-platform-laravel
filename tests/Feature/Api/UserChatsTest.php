<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Chat;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserChatsTest extends TestCase
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
    public function it_gets_user_chats(): void
    {
        $user = User::factory()->create();
        $chats = Chat::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.chats.index', $user));

        $response->assertOk()->assertSee($chats[0]->content);
    }

    /**
     * @test
     */
    public function it_stores_the_user_chats(): void
    {
        $user = User::factory()->create();
        $data = Chat::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.chats.store', $user),
            $data
        );

        unset($data['content']);
        unset($data['status']);
        unset($data['conversation_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('chats', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $chat = Chat::latest('id')->first();

        $this->assertEquals($user->id, $chat->user_id);
    }
}
