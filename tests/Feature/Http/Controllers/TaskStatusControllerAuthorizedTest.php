<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskStatusControllerAuthorizedTest extends TestCase
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

        $user = User::factory()->create();
        Auth::login($user);
    }

    public function testIndex(): void
    {
        $response = $this->get('/task_statuses/');
        $response->assertOk();

        $response->assertSee(__('views.buttons.delete'));
        $response->assertSee(__('views.buttons.edit'));
        $response->assertSee(__('views.buttons.create'));

        $response->assertSee('status');
    }

    public function testUpdate(): void
    {
        $response = $this->get('/task_statuses/5/edit');
        $response->assertOk();

        $this->patch('/task_statuses/5', [
            'name' => 'updatedStatus'
        ]);
        $response->assertOk();

        $status = TaskStatus::where('id', '5')->get()->first();
        $this->assertEquals('updatedStatus', $status->name);
    }

    public function testCreate(): void
    {
        $response = $this->get('/task_statuses/create');
        $response->assertOk();

        $response = $this->post('/task_statuses/', [
            'name' => 'newStatus'
        ]);
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'newStatus'
        ]);
    }

    public function testDelete(): void
    {
        $response = $this->delete('/task_statuses/5');
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', [
            'name' => 'status'
        ]);
    }
}
