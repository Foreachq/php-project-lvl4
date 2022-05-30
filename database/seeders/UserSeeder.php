<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->state([
                'name' => 'Test User',
                'email' => 'testUser@email.com',
            ])
            ->create();
    }
}
