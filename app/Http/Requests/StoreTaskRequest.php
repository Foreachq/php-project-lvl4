<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:tasks|max:255',
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
