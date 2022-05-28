@extends('layouts.app')

@section('content')
<h1 class="mb-5">@lang('layouts.app.labels')</h1>
@can('create', App\Models\Label::class)
    <a href="{{ route('labels.create') }}" class="btn btn-primary">@lang('views.label.index.create')</a>
@endcan
<table class="table mt-2">
    <thead>
    <tr>
        <th>ID</th>
        <th>@lang('views.label.name')</th>
        <th>@lang('views.label.description')</th>
        <th class="col-md-2">@lang('views.label.created_at')</th>
        @if(Auth::check())
            <th class="col-md-2">@lang('views.label.actions')</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($labels as $label)
    <tr>
        <td>{{ $label->id }}</td>
        <td>{{ $label->name }}</td>
        <td>{{ $label->description }}</td>
        <td>{{ $label->created_at->format('d.m.Y') }}</td>
        @canany(['update', 'delete'], $label)
        <td>
            <a class="text-danger text-decoration-none" href="{{ route('labels.destroy', $label) }}"
               data-confirm="{{ __('messages.ujs.sure') }}" data-method="delete">@lang('views.buttons.delete')</a>
            /
            <a class="text-decoration-none" href="{{ route('labels.edit', $label) }}">
                @lang('views.buttons.edit')</a>
        </td>
        @endcan
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
