<div class="form-group mb-3">
    {{ Form::label('name', __('views.label.name')) }}
    {{ Form::text('name', null, $errors->has('name')
        ? ['class' => 'form-control is-invalid']
        : ['class' => 'form-control']) }}
    @error('name')
    <div class="text-danger mt-1" role="alert">
        <small>{{ $message }}</small>
    </div>
    @enderror
</div>

<div class="form-group mb-3">
    {{ Form::label('description', __('views.task.description')) }}
    {{ Form::textArea('description', null, ['class' => 'form-control']) }}
    @error('description')
    <div class="text-danger mt-1" role="alert">
        <small>{{ $message }}</small>
    </div>
    @enderror
</div>
