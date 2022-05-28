<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {
        $this->authorizeResource(Task::class);
    }

    public function show(Task $task): Factory|View|Application
    {
        return view('tasks.show', compact('task'));
    }

    public function index(): Factory|View|Application
    {
        $tasks = Task::all()->sortBy('id');

        return view('tasks.index', compact('tasks'));
    }

    public function create(): Factory|View|Application
    {
        $task = new Task();

        $users = User::all()->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return view('tasks.create', compact('task', 'users', 'statuses', 'labels'));
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {
        $task = new Task();

        $this->taskService->updateTask($request, $task, Auth::user());

        flash(__('messages.flash.task.success.create'))->success();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task): Factory|View|Application
    {
        $users = User::all()->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'users', 'statuses', 'labels'));
    }

    public function update(TaskUpdateRequest $request, Task $task): RedirectResponse
    {
        $this->taskService->updateTask($request, $task);

        flash(__('messages.flash.task.success.update'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash(__('messages.flash.task.success.delete'))->success();

        return redirect()->route('tasks.index');
    }
}
