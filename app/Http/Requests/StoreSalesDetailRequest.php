<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_id' => 'required|integer|exists:sales,sale_id',
            'product_id' => 'required|integer|exists:product,product_id',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'totalamount' => 'required|numeric|min:0',
        ];
    }
}