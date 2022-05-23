<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:task_statuses',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('messages.status.name.required'),
            'name.unique' => __('messages.status.name.unique'),
        ];
    }
}
