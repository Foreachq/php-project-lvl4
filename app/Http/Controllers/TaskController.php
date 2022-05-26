<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function show(Task $task): Factory|View|Application
    {
        Gate::authorize('viewAny', Task::class);

        return view('tasks.show', compact('task'));
    }

    public function index(): Factory|View|Application
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create(): Factory|View|Application
    {
        Gate::authorize('create', Task::class);

        $task = new Task();

        $users = User::all()->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id');

        return view('tasks.create', compact('task', 'users', 'statuses'));
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {
        Gate::authorize('create', Task::class);

        $task = new Task();
        $this->fillTask($request, $task);
        $task->creator()->associate(Auth::user());

        $task->save();

        flash(__('messages.flash.task.success.create'))->success();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task): Factory|View|Application
    {
        Gate::authorize('update', $task);

        $users = User::all()->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'users', 'statuses'));
    }

    public function update(TaskUpdateRequest $request, Task $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $this->fillTask($request, $task);
        $task->save();

        flash(__('messages.flash.task.success.update'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete', $task);

        $task->delete();

        flash(__('messages.flash.task.success.delete'))->success();

        return redirect()->route('tasks.index');
    }

    public function fillTask(FormRequest $request, Task $task): void
    {
        $task->fill($request->all());

        $statusId = $request->get('status_id');
        $status = TaskStatus::find($statusId);

        $executorId = $request->get('assigned_to_id');
        $executor = TaskStatus::find($executorId);

        $task->executor()->associate($executor);
        $task->status()->associate($status);
    }
}
