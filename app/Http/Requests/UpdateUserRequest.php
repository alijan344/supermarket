<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('user');

        return [
            'employee_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:employee,employee_id',
                Rule::unique('users', 'employee_id')->ignore($employeeId, 'employee_id'),
            ],

            'username' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($employeeId, 'employee_id'),
            ],

            'password' => 'sometimes|required|string|min:6',
        ];
    }
}