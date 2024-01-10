<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'status' => $this->faker->boolean(),
            'conversation_id' => \App\Models\Conversation::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
