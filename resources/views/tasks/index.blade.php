@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task.title')</h1>
    <div class="d-flex mb-3">
        <div class="w-75">
            <p class="mb-1">@lang('views.task.filter'):</p>
            {{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
                <div class="row g-1">
                    <div class="col">
                        {{ Form::select('filter[status_id]', $statuses->union(['' => __('views.task.status')])->sortKeys(), $filter['status_id'], ['class' => 'form-select me-2']) }}
                    </div>
                    <div class="col">
                        {{ Form::select('filter[created_by_id]', $users->union(['' => __('views.task.author')])->sortKeys(), $filter['created_by_id'], ['class' => 'form-select me-2']) }}
                    </div>
                    <div class="col">
                        {{ Form::select('filter[assigned_to_id]', $users->union(['' => __('views.task.executor')])->sortKeys(), $filter['assigned_to_id'], ['class' => 'form-select me-2']) }}
                    </div>
                    <div class="col">
                        {{ Form::submit(__('views.buttons.submit'), ['class' => 'btn btn-outline-primary me-2']) }}
                        <a class="btn btn-outline-dark" href="{{ route('tasks.index') }}" role="button">@lang('views.buttons.resetFilter')</a>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <div class="ms-auto align-self-end">
            @can('create', App\Models\Task::class)
            <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">
                @lang('views.task.create.title')
            </a>
            @endcan
        </div>
    </div>
    <table class="table me-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>@lang('views.task.status')</th>
            <th>@lang('views.task.name')</th>
            <th>@lang('views.task.author')</th>
            <th>@lang('views.task.executor')</th>
            <th>@lang('views.task.created_at')</th>
            @if(Auth::check())
            <th>@lang('views.task.actions')</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->status->name }}</td>
            <td>
                <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
            </td>
            <td>{{ $task->creator->name }}</td>
            <td>{{ $task->executor->name ?? '' }}</td>
            <td>{{ $task->created_at->format('d.m.Y') }}</td>
            @canany(['update', 'delete'], $task)
            <td>
                @can('delete', $task)
                <a class="text-danger text-decoration-none" href="{{ route('tasks.destroy', $task) }}"
                   data-confirm="{{ __('messages.ujs.sure') }}" data-method="delete">@lang('views.buttons.delete')</a>
                /
                @endcan
                <a class="text-decoration-none" href="{{ route('tasks.edit', $task) }}">@lang('views.buttons.edit')</a>
            </td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }}
@endsection
