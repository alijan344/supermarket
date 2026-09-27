<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:product,product_id',
            'return_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0',
        ];
    }
}