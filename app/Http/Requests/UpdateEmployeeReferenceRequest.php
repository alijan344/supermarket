<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeReferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'sometimes|required|integer|exists:employee,employee_id',
            'reference_name' => 'sometimes|required|string|max:255',
            'organization' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|nullable|email|max:255',
        ];
    }
}