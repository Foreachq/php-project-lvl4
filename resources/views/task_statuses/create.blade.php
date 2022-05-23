@extends('layouts.app')

@section('title')
    @lang('views.status.create.title')
@endsection

@section('content')
    <h1 class="mb-5">@lang('views.status.create.title')</h1>
    {{ Form::model($status, ['route' => 'task_statuses.store', 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('views.status.create.submit'), ['class' => 'btn btn-primary mt-2']) }}
    {{ Form::close() }}
@endsection
