<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_id' => 'sometimes|required|integer|exists:sales,sale_id',
            'product_id' => 'sometimes|required|integer|exists:product,product_id',
            'quantity' => 'sometimes|required|integer|min:1',
            'unitprice' => 'sometimes|required|numeric|min:0',
            'totalprice' => 'sometimes|required|numeric|min:0',
            'discount' => 'sometimes|required|numeric|min:0',
            'totalamount' => 'sometimes|required|numeric|min:0',
        ];
    }
}