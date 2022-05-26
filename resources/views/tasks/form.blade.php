<div class="form-group mb-3">
    {{ Form::label('name', __('views.task.name')) }}
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
</div>

<div class="form-group mb-3">
    {{ Form::label('status_id', __('views.task.status')) }}
    {{ Form::select('status_id', $statuses->union(['' => '----------'])->sortKeys(), $task->status->id ?? '', $errors->has('status_id')
        ? ['class' => 'form-control is-invalid']
        : ['class' => 'form-control']) }}
@error('status_id')
<div class="text-danger mt-1" role="alert">
    <small>{{ $message }}</small>
</div>
@enderror
</div>

<div class="form-group mb-3">
    {{ Form::label('assigned_to_id', __('views.task.executor')) }}
    {{ Form::select('assigned_to_id', $users->union(['' => '----------'])->sortKeys(), $task->executor->id ?? '', ['class' => 'form-control']) }}
</div>
