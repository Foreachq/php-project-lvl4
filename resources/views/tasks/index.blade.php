@extends('layouts.app')

@section('title')
    @lang('views.task.title')
@endsection

@section('content')
    <h1 class="mb-5">@lang('views.task.title')</h1>
    <div class="d-flex mb-3">
        <div class="ms-auto">
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
@endsection
