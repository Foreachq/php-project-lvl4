@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.label.edit.title')</h1>
    {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('labels.form')
    {{ Form::submit(__('views.buttons.update'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
