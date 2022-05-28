<?php

namespace Tests\Feature\Http\Controllers\Unauthorized;

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
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();

        $response->assertDontSee(__('views.buttons.delete'));
        $response->assertDontSee(__('views.buttons.edit'));
        $response->assertDontSee(__('views.buttons.create'));

        $response->assertSee('status');
    }

    public function testUpdate(): void
    {
        $response = $this->get(route('task_statuses.edit', 1));
        $response->assertStatus(403);

        $response = $this->patch(route('task_statuses.update', 1), [
            'name' => 'updatedStatus'
        ]);
        $response->assertStatus(403);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(403);

        $response = $this->post(route('task_statuses.store'), [
            'name' => 'newStatus'
        ]);
        $response->assertStatus(403);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('task_statuses.destroy', 1));
        $response->assertStatus(403);
    }
}
