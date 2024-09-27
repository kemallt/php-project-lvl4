<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|integer|exists:users,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return parent::failedValidation($validator);
    }

    public function messages()
    {
        return [
            'name.required' => __('validations.task_name_required'),
            'status_id.required' => __('validations.task_status_required'),
            'assigned_to_id.exists' => __('validations.task_has_wrong_assigned_to_id'),
            'status_id.exists' => __('validations.task_has_wrong_status'),
        ];
    }
}
