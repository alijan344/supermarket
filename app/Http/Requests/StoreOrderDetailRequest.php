<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|integer|exists:orders,order_id',
            'product_id' => 'required|integer|exists:product,product_id',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0',
            'remark' => 'nullable|string',
        ];
    }
}