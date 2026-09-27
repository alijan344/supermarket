<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'sometimes|required|integer|exists:employee,employee_id',
            'head' => 'sometimes|boolean',
            'hr' => 'sometimes|boolean',
            'inventory' => 'sometimes|boolean',
            'finance' => 'sometimes|boolean',
        ];
    }
}