<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBuyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        

        return [
            'product_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:product,product_id',
            ],

            'product_name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',

            'quantity' => 'sometimes|required|integer|min:1',
            'unitprice' => 'sometimes|required|numeric|min:0',
            'totalprice' => 'sometimes|required|numeric|min:0',

            'supplier_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:supplier,supplier_id',
            ],

            'employee_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:employee,employee_id',
            ],

            'buy_date' => 'sometimes|required|date',
            'manufacture_date' => 'sometimes|required|date',

            'expire_date' => [
                'sometimes',
                'required',
                'date',
                'after_or_equal:manufacture_date',
            ],
        ];
    }
}