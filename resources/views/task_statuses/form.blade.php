<div class="form-group mb-3">
    {{ Form::label('name', __('views.status.create.name')) }}

    @if ($errors->any())
        {{ Form::text('name', null, ['class' => 'form-control is-invalid']) }}
        @foreach ($errors->all() as $error)
            <div class="text-danger mt-1" role="alert">
                <small>{{ $error }}</small>
            </div>
        @endforeach
    @else
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    @endif
</div>

