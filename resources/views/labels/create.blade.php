@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.label.index.create')</h1>
    {{ Form::model($label, ['route' => 'labels.store', 'class' => 'w-50']) }}
    @include('labels.form')
    {{ Form::submit(__('views.buttons.create'), ['class' => 'btn btn-primary mt-2']) }}
    {{ Form::close() }}
@endsection
