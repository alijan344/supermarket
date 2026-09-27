<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subscriber_id' => 'sometimes|required|integer|exists:subscriber,subscriber_id',
            'order_date' => 'sometimes|required|date',
        ];
    }
}