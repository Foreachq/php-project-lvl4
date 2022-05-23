<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class TaskStatusController extends Controller
{
    private const UNTOUCHABLE_STATUSES_ID = [1, 2, 3, 4];

    public function show()
    {
        abort(404);
    }

    public function index(): Application|Factory|View
    {
        $statuses = TaskStatus::all();

        return view('task_statuses.index', compact('statuses'));
    }

    public function create(): Factory|View|Application
    {
        Gate::authorize('create', TaskStatus::class);
        $status = new TaskStatus();

        return view('task_statuses.create', compact('status'));
    }

    public function store(TaskStatusRequest $request): RedirectResponse
    {
        Gate::authorize('create', TaskStatus::class);

        $status = new TaskStatus();
        $status->fill($request->all());
        $status->save();

        flash(__('messages.flash.status.success.create'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): Factory|View|Application
    {
        Gate::authorize('update', $taskStatus);

        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        Gate::authorize('update', $taskStatus);

        $taskStatus->fill($request->all());
        $taskStatus->save();
        flash(__('messages.flash.status.success.update'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        Gate::authorize('delete', $taskStatus);

        $exceptions = collect(self::UNTOUCHABLE_STATUSES_ID);

        if (!$exceptions->contains($taskStatus->id)) {
            $taskStatus->delete();

            flash(__('messages.flash.status.success.delete'))->success();
        } else {
            flash(__('messages.flash.status.fail.delete'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
