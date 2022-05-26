<div class="form-group mb-3">
    {{ Form::label('name', __('views.status.name')) }}
    {{ Form::text('name', null, $errors->any()
        ? ['class' => 'form-control is-invalid']
        : ['class' => 'form-control']) }}

    @foreach ($errors->all() as $error)
        <div class="text-danger mt-1" role="alert">
            <small>{{ $error }}</small>
        </div>
    @endforeach
</div>

