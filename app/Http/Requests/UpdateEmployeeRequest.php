<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'firstname' => 'sometimes|required|string|max:255',
            'lastname' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'education' => 'sometimes|required|string|max:255',

            'phone' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('employee', 'phone')->ignore($employeeId, 'employee_id'),
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('employee', 'email')->ignore($employeeId, 'employee_id'),
            ],

            'address' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|string|max:20',
            'hire_date' => 'sometimes|required|date',
            'dob' => 'sometimes|required|date',
            'marital_status' => 'sometimes|required|string|max:50',
            'salary' => 'sometimes|required|numeric|min:0',
            'shift' => 'sometimes|required|string|max:50',
        ];
    }
}