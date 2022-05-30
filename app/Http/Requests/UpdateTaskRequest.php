<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $task = $this->route('task');

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('tasks')->ignore($task->id),
            ],
            'status_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('messages.form.required'),
            'name.unique' => __('messages.form.task.name.unique'),
            'status_id.required' => __('messages.form.required'),
        ];
    }
}
