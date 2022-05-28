<?php

namespace Tests\Feature\Http\Controllers\Authorized;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskControllerAuthorizedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $seeder = new DatabaseSeeder();
        $seeder->run();

        $user = User::factory()->create();
        Auth::login($user);

        Label::factory()
            ->count(4)
            ->state(new Sequence(
                ['name' => 'баг'],
                ['name' => 'фича'],
                ['name' => 'дубликат']
            ))
            ->create();

        Task::factory()
            ->state([
                'name' => 'testTask',
                'created_by_id' => $user,
                'status_id' => '1',
            ])
            ->create();

        Task::factory()
            ->state([
                'name' => 'foreignTask',
                'created_by_id' => User::factory()->create(),
                'status_id' => '1',
            ])
            ->create();
    }

    public function testShow(): void
    {
        $response = $this->get(route('tasks.show', 1));
        $response->assertOk();

        $response->assertSee('testTask');
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();

        $response->assertSee(__('views.buttons.delete'));
        $response->assertSee(__('views.buttons.edit'));
        $response->assertSee(__('views.buttons.create'));

        $response->assertSee('testTask');
    }

    public function testUpdate(): void
    {
        $response = $this->get(route('tasks.edit', 1));
        $response->assertOk();

        $label = Label::find(1);

        $this->patch(route('tasks.update', 1), [
            'name' => 'updatedTask',
            'status_id' => '1',
            'labels' => [$label->id],
        ]);
        $response->assertOk();

        $task = Task::where('id', '1')->first();

        $this->assertEquals('updatedTask', $task->name);
        $this->assertEquals(1, $task->labels->count());
        $this->assertEquals($label->id, $task->labels[0]->id);
    }

    public function testUpdateForeignTask(): void
    {
        $response = $this->get(route('tasks.edit', 2));
        $response->assertOk();

        $this->patch(route('tasks.update', 2), [
            'name' => 'updatedForeignTask',
            'status_id' => '1'
        ]);
        $response->assertOk();

        $task = Task::where('id', '2')->first();
        $this->assertEquals('updatedForeignTask', $task->name);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();

        $response = $this->post(route('tasks.store'), [
            'name' => 'newTask',
            'status_id' => '1'
        ]);
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'newTask'
        ]);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('tasks.destroy', 1));
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'name' => 'task'
        ]);
    }

    public function testDeleteForeignTask(): void
    {
        $response = $this->delete(route('tasks.destroy', 2));
        $response->assertStatus(403);
    }
}
