<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric|min:0',
            'currency' => 'sometimes|required|string|max:50',
            'pay_date' => 'sometimes|required|date',
            'employee_id' => 'sometimes|nullable|integer|exists:employee,employee_id',
            'receiver' => 'sometimes|required|string|max:255',
        ];
    }
}