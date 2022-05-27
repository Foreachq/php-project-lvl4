<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;

class TaskService
{
    public function updateTask(FormRequest $request, Task $task, Authenticatable $creator = null): void
    {
        $task->fill($request->all());

        $statusId = $request->get('status_id');
        $status = TaskStatus::find($statusId);

        $executorId = $request->get('assigned_to_id');
        $executor = TaskStatus::find($executorId);

        $task->executor()->associate($executor);
        $task->status()->associate($status);

        if ($creator) {
            $task->creator()->associate($creator);
        }

        $task->save();
    }
}
