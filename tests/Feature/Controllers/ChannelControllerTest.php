<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Channel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_channels(): void
    {
        $channels = Channel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('channels.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.channels.index')
            ->assertViewHas('channels');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_channel(): void
    {
        $response = $this->get(route('channels.create'));

        $response->assertOk()->assertViewIs('app.channels.create');
    }

    /**
     * @test
     */
    public function it_stores_the_channel(): void
    {
        $data = Channel::factory()
            ->make()
            ->toArray();

        $data['configuration'] = json_encode($data['configuration']);

        $response = $this->post(route('channels.store'), $data);

        $data['configuration'] = $this->castToJson($data['configuration']);

        $this->assertDatabaseHas('channels', $data);

        $channel = Channel::latest('id')->first();

        $response->assertRedirect(route('channels.edit', $channel));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_channel(): void
    {
        $channel = Channel::factory()->create();

        $response = $this->get(route('channels.show', $channel));

        $response
            ->assertOk()
            ->assertViewIs('app.channels.show')
            ->assertViewHas('channel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_channel(): void
    {
        $channel = Channel::factory()->create();

        $response = $this->get(route('channels.edit', $channel));

        $response
            ->assertOk()
            ->assertViewIs('app.channels.edit')
            ->assertViewHas('channel');
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

        $data['configuration'] = json_encode($data['configuration']);

        $response = $this->put(route('channels.update', $channel), $data);

        $data['id'] = $channel->id;

        $data['configuration'] = $this->castToJson($data['configuration']);

        $this->assertDatabaseHas('channels', $data);

        $response->assertRedirect(route('channels.edit', $channel));
    }

    /**
     * @test
     */
    public function it_deletes_the_channel(): void
    {
        $channel = Channel::factory()->create();

        $response = $this->delete(route('channels.destroy', $channel));

        $response->assertRedirect(route('channels.index'));

        $this->assertModelMissing($channel);
    }
}
