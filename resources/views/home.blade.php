@extends('layouts.app')

@section('content')
    <div class="p-5 mb-4 bg-light border rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-6 fw-bold">@lang('views.home.welcome')</h1>
            <p class="col-md-8 fs-5">@lang('views.home.description')</p>
        </div>
    </div>
@endsection
