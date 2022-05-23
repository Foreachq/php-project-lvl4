@extends('layouts.app')

@section('title')
    @lang('views.status.title')
@endsection

@section('content')
<h1 class="mb-5">@lang('layouts.app.statuses')</h1>
@if (Auth::check())
    <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">@lang('views.status.index.create')</a>
@endif
<table class="table mt-2">
    <thead>
    <tr>
        <th>ID</th>
        <th>@lang('views.status.index.name')</th>
        <th class="col-md-2">@lang('views.status.index.created_at')</th>
        @if (Auth::check())
            <th class="col-md-2">@lang('views.status.index.actions')</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($statuses as $status)
    <tr>
        <td>{{ $status->id }}</td>
        <td>{{ $status->name }}</td>
        <td>{{ $status->created_at->format('d.m.Y') }}</td>
        @if (Auth::check())
        <td>
            <a class="text-danger text-decoration-none" href="{{ route('task_statuses.destroy', $status) }}"
               data-confirm="{{ __('messages.ujs.sure') }}" data-method="delete">@lang('views.status.index.destroy')</a>
            /
            <a class="text-decoration-none" href="{{ route('task_statuses.edit', $status) }}">
                @lang('views.status.index.edit')</a>
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
