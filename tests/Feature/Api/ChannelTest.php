<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Channel;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
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
    public function it_gets_channels_list(): void
    {
        $channels = Channel::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.channels.index'));

        $response->assertOk()->assertSee($channels[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_channel(): void
    {
        $data = Channel::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.channels.store'), $data);

        $this->assertDatabaseHas('channels', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_channel(): void
    {
        $channel = Channel::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'icon' => $this->faker->text(255),
            'configuration' => [],
            'status' => $this->faker->boolean(),
        ];

        $response = $this->putJson(
            route('api.channels.update', $channel),
            $data
        );

        $data['id'] = $channel->id;

        $this->assertDatabaseHas('channels', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_channel(): void
    {
        $channel = Channel::factory()->create();

        $response = $this->deleteJson(route('api.channels.destroy', $channel));

        $this->assertModelMissing($channel);

        $response->assertNoContent();
    }
}
