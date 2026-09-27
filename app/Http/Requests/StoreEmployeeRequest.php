<?php

namespace App\Http\Requests;
use App\Http\Requests\UpdateEmployeeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'education' => 'required|string|max:255',

            'phone' => 'required|string|max:20|unique:employee,phone',

            'email' => 'nullable|email|max:255|unique:employee,email',

            'address' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'hire_date' => 'required|date',
            'dob' => 'required|date',
            'marital_status' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
            'shift' => 'required|string|max:50',
        ];
    }
}