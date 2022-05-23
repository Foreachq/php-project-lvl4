@extends('layouts.app')

@section('title')
    @lang('views.statuses.title')
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-5">@lang('layouts.app.statuses')</h1>
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">@lang('views.status.index.create')</a>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>@lang('views.status.index.name')</th>
                <th>@lang('views.status.index.created_at')</th>
                <th>@lang('views.status.index.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                <td>
                    <a class="text-danger text-decoration-none" href="{{ route('task_statuses.destroy', $status) }}"
                       data-confirm="Вы уверены?" data-method="delete">@lang('views.status.index.destroy')</a>
                    <a class="text-decoration-none" href="{{ route('task_statuses.edit', $status) }}">
                        @lang('views.status.index.edit')</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
