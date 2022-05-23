<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class TaskStatusControllerUnauthorizedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $seeder = new DatabaseSeeder();
        $seeder->run();

        TaskStatus::factory()
            ->state([
                'name' => 'status'
            ])
            ->create();
    }

    public function testIndex(): void
    {
        $response = $this->get('/task_statuses/');
        $response->assertOk();

        $response->assertDontSee(__('views.status.index.destroy'));
        $response->assertDontSee(__('views.status.index.edit'));
        $response->assertDontSee(__('views.status.index.create'));

        $response->assertSee('status');
    }

    public function testUpdate(): void
    {
        $response = $this->get('/task_statuses/1/edit');
        $response->assertStatus(403);

        $response = $this->patch('/task_statuses/1', [
            'name' => 'updatedStatus'
        ]);
        $response->assertStatus(403);
    }

    public function testCreate(): void
    {
        $response = $this->get('/task_statuses/create');
        $response->assertStatus(403);

        $response = $this->post('/task_statuses/', [
            'name' => 'updatedStatus'
        ]);
        $response->assertStatus(403);
    }

    public function testDelete(): void
    {
        $response = $this->delete('/task_statuses/1');
        $response->assertStatus(403);
    }
}
