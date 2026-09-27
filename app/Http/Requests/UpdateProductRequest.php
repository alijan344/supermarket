<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'unitprice' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
            'image' => 'sometimes|nullable|string|max:255',
            'store_date' => 'sometimes|required|date',
            'location' => 'sometimes|required|string|max:255',
        ];
    }
}