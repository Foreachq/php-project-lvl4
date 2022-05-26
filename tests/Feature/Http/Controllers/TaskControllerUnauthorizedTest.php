<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Task;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class TaskControllerUnauthorizedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $seeder = new DatabaseSeeder();
        $seeder->run();

        Task::factory()
            ->state([
                'name' => 'testTask',
                'status_id' => '1',
            ])
            ->create();
    }

    public function testShow(): void
    {
        $response = $this->get(route('tasks.show', 1));
        $response->assertStatus(403);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();

        $response->assertDontSee(__('views.buttons.delete'));
        $response->assertDontSee(__('views.buttons.edit'));
        $response->assertDontSee(__('views.buttons.create'));

        $response->assertSee('testTask');
    }

    public function testUpdate(): void
    {
        $response = $this->get(route('tasks.edit', 1));
        $response->assertStatus(403);

        $this->patch(route('tasks.update', 1), [
            'name' => 'updatedTask',
            'status_id' => '1'
        ]);
        $response->assertStatus(403);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);

        $response = $this->post(route('tasks.store'), [
            'name' => 'newTask',
            'status_id' => '1'
        ]);
        $response->assertStatus(403);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('tasks.destroy', 1));
        $response->assertStatus(403);
    }
}
