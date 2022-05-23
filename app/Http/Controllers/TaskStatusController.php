<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function show(): RedirectResponse
    {
        return redirect()->route('task_statuses.index');
    }

    public function index(): Application|Factory|View
    {
        $statuses = TaskStatus::all();

        return view('task_statuses.index', compact('statuses'));
    }

    public function create(): Factory|View|Application
    {
        $status = new TaskStatus();

        return view('task_statuses.create', compact('status'));
    }

    public function store(TaskStatusRequest $request): RedirectResponse
    {
        $status = new TaskStatus();
        $status->fill($request->all());
        $status->save();
        flash(__('messages.flash.status.success.create'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): Factory|View|Application
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->fill($request->all());
        $taskStatus->save();
        flash(__('messages.flash.status.success.update'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->delete();
        flash(__('messages.flash.status.success.delete'))->success();

        return redirect()->route('task_statuses.index');
    }
}
