<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskStatusRequest extends FormRequest
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
        flash(@lang('main.flashes.cannot_add_status'))->error();
        return parent::failedValidation($validator);    
    }

    public function messages()
    {
        return [
            'name.required' => @lang('validations.status_name_required'),
            'name.unique' => @lang('validations.status_name_not_unique'),
        ];
    }
}
