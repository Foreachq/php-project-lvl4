@extends('layouts.app')

@section('title')
    @lang('views.task.edit.title')
@endsection

@section('content')
    <h1 class="mb-5">@lang('views.task.edit.title')</h1>
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('tasks.form')
    {{ Form::submit(__('views.buttons.update'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
