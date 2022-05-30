<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $taskStatus = $this->route('task_status');

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('task_statuses')->ignore($taskStatus->id),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('messages.form.required'),
            'name.unique' => __('messages.form.status.name.unique'),
        ];
    }
}
