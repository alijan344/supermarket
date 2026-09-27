<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|required|integer|exists:orders,order_id',
            'product_id' => 'sometimes|required|integer|exists:product,product_id',
            'quantity' => 'sometimes|required|integer|min:1',
            'unitprice' => 'sometimes|required|numeric|min:0',
            'totalprice' => 'sometimes|required|numeric|min:0',
            'remark' => 'sometimes|nullable|string',
        ];
    }
}