<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplierId = $this->route('supplier');

        return [
            'name' => 'sometimes|required|string|max:255',

            'phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:20',
                Rule::unique('supplier', 'phone')->ignore($supplierId, 'supplier_id'),
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('supplier', 'email')->ignore($supplierId, 'supplier_id'),
            ],

            'supplier_type' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
        ];
    }
}