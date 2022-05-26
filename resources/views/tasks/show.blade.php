@extends('layouts.app')

@section('title')
    @lang('views.task.show.title'): {{ $task->name }}
@endsection

@section('content')
    <h1 class="mb-5">
        @lang('views.task.show.title'): {{ $task->name }}
    </h1>
    <span class="h-50"></span>
    <p>@lang('views.task.name'): {{ $task->name }}</p>
    <p>@lang('views.task.status'): {{ $task->status->name }}</p>
    <p>@lang('views.task.description'): {{ $task->description }}</p>
    <a class="btn btn-outline-primary mt-3" href="{{ route('tasks.edit', $task) }}" role="button">@lang('views.buttons.edit') ✏</a>
@endsection
