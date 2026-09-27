<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:50',
            'pay_date' => 'required|date',
            'employee_id' => 'nullable|integer|exists:employee,employee_id',
            'receiver' => 'required|string|max:255',
        ];
    }
}