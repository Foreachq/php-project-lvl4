<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index(): Application|Factory|View
    {
        $statuses = TaskStatus::all();

        return view('task_statuses.index', compact('statuses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(TaskStatus $taskStatus)
    {
        //
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        //
    }

    public function destroy(TaskStatus $taskStatus)
    {
        //
    }
}
