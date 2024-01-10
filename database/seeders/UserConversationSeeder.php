<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserConversation;

class UserConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserConversation::factory()
            ->count(5)
            ->create();
    }
}
