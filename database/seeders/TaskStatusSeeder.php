<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        TaskStatus::factory()
            ->count(4)
            ->state(new Sequence(
                ['name' => 'новый'],
                ['name' => 'в работе'],
                ['name' => 'на тестировании'],
                ['name' => 'завершен'],
            ))
            ->create();
    }
}
