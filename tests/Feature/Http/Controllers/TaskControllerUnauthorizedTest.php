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
        $response = $this->get('/tasks/1');
        $response->assertStatus(403);
    }

    public function testIndex(): void
    {
        $response = $this->get('/tasks/');
        $response->assertOk();

        $response->assertDontSee(__('views.buttons.delete'));
        $response->assertDontSee(__('views.buttons.edit'));
        $response->assertDontSee(__('views.buttons.create'));

        $response->assertSee('testTask');
    }

    public function testUpdate(): void
    {
        $response = $this->get('/tasks/1/edit');
        $response->assertStatus(403);

        $this->patch('/tasks/1', [
            'name' => 'updatedTask',
            'status_id' => '1'
        ]);
        $response->assertStatus(403);
    }

    public function testCreate(): void
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(403);

        $response = $this->post('/tasks/', [
            'name' => 'newTask',
            'status_id' => '1'
        ]);
        $response->assertStatus(403);
    }

    public function testDelete(): void
    {
        $response = $this->delete('/tasks/1');
        $response->assertStatus(403);
    }
}
