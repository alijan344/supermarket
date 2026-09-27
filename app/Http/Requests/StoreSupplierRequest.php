<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20|unique:supplier,phone',
            'email' => 'nullable|email|max:255|unique:supplier,email',
            'supplier_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }
}