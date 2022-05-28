<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class TaskService
{
    public function filterTasks(array $filter): Collection
    {
        $taskQuery = Task::query();

        if ($filter['status_id'] !== '') {
            $taskQuery = $taskQuery->where('status_id', $filter['status_id']);
        }

        if ($filter['created_by_id'] !== '') {
            $taskQuery = $taskQuery->where('created_by_id', $filter['created_by_id']);
        }

        if ($filter['assigned_to_id'] !== '') {
            $taskQuery = $taskQuery->where('assigned_to_id', $filter['assigned_to_id']);
        }

        return $taskQuery->get()->sortBy('id');
    }

    public function updateTask(FormRequest $request, Task $task, Authenticatable $creator = null): void
    {
        $task->fill($request->all());

        $statusId = $request->get('status_id');
        $status = TaskStatus::find($statusId);

        $executorId = $request->get('assigned_to_id');
        $executor = TaskStatus::find($executorId);

        $labelIds = collect($request->get('labels'));
        $labelIds = $labelIds->filter();

        $task->labels()->detach();
        if ($labelIds->count() !== 0) {
            $task->labels()->attach($labelIds);
        }

        $task->executor()->associate($executor);
        $task->status()->associate($status);

        if ($creator !== null) {
            $task->creator()->associate($creator);
        }

        $task->save();
    }
}
