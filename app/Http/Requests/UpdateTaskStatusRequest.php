<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:task_statuses,name',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return parent::failedValidation($validator);
    }

    public function messages()
    {
        return [
            'name.required' => __('validations.status_name_required'),
            'name.unique' => __('validations.status_name_not_unique'),
        ];
    }
}
