@extends('layouts.app')

@section('title')
    @lang('views.task.create.title')
@endsection

@section('content')
    <h1 class="mb-5">@lang('views.task.create.title')</h1>
    {{ Form::model($task, ['route' => 'tasks.store', 'class' => 'w-50']) }}
    @include('tasks.form')
    {{ Form::submit(__('views.buttons.create'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
