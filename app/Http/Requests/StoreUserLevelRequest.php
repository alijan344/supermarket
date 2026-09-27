<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|integer|exists:employee,employee_id|unique:user_level,employee_id',
            'head' => 'boolean',
            'hr' => 'boolean',
            'inventory' => 'boolean',
            'finance' => 'boolean',
        ];
    }
}