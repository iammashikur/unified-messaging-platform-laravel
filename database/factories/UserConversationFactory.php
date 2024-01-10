<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UserConversation;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserConversationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserConversation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conversation_id' => \App\Models\Conversation::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
