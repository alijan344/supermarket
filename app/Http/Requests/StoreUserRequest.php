<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|integer|exists:employee,employee_id|unique:users,employee_id',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ];
    }
}