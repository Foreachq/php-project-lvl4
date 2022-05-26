@extends('layouts.app')

@section('title')
    @lang('views.status.edit.title')
@endsection

@section('content')
    <h1 class="mb-5">@lang('views.status.edit.title')</h1>
    {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('views.buttons.update'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
