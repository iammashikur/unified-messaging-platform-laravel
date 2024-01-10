<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Conversation;

use App\Models\Channel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_conversations(): void
    {
        $conversations = Conversation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('conversations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.conversations.index')
            ->assertViewHas('conversations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_conversation(): void
    {
        $response = $this->get(route('conversations.create'));

        $response->assertOk()->assertViewIs('app.conversations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_conversation(): void
    {
        $data = Conversation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('conversations.store'), $data);

        $this->assertDatabaseHas('conversations', $data);

        $conversation = Conversation::latest('id')->first();

        $response->assertRedirect(route('conversations.edit', $conversation));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_conversation(): void
    {
        $conversation = Conversation::factory()->create();

        $response = $this->get(route('conversations.show', $conversation));

        $response
            ->assertOk()
            ->assertViewIs('app.conversations.show')
            ->assertViewHas('conversation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_conversation(): void
    {
        $conversation = Conversation::factory()->create();

        $response = $this->get(route('conversations.edit', $conversation));

        $response
            ->assertOk()
            ->assertViewIs('app.conversations.edit')
            ->assertViewHas('conversation');
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

        $response = $this->put(
            route('conversations.update', $conversation),
            $data
        );

        $data['id'] = $conversation->id;

        $this->assertDatabaseHas('conversations', $data);

        $response->assertRedirect(route('conversations.edit', $conversation));
    }

    /**
     * @test
     */
    public function it_deletes_the_conversation(): void
    {
        $conversation = Conversation::factory()->create();

        $response = $this->delete(
            route('conversations.destroy', $conversation)
        );

        $response->assertRedirect(route('conversations.index'));

        $this->assertModelMissing($conversation);
    }
}
