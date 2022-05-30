<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:task_statuses|max:255',
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
