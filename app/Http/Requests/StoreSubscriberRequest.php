<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subscriber_name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20|unique:subscriber,phone',
            'email' => 'nullable|email|max:255|unique:subscriber,email',
            'dob' => 'required|date',
            'gender' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ];
    }
}