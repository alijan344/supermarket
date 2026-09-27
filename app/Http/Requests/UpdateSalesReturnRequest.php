<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'sometimes|required|integer|exists:product,product_id',
            'return_date' => 'sometimes|required|date',
            'reason' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:1',
            'unitprice' => 'sometimes|required|numeric|min:0',
            'totalprice' => 'sometimes|required|numeric|min:0',
        ];
    }
}