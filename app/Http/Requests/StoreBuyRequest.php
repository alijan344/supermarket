<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:product,product_id',
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0',
            'supplier_id' => 'required|integer|exists:supplier,supplier_id',
            'employee_id' => 'required|integer|exists:employee,employee_id',
            'buy_date' => 'required|date',
            'manufacture_date' => 'required|date',
            'expire_date' => 'required|date|after_or_equal:manufacture_date',
        ];
    }
}