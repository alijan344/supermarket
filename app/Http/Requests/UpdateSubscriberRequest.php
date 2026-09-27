<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubscriberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $subscriberId = $this->route('subscriber');

        return [
            'subscriber_name' => 'sometimes|required|string|max:255',

            'image' => 'sometimes|nullable|string|max:255',

            'phone' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('subscriber', 'phone')
                    ->ignore($subscriberId, 'subscriber_id'),
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('subscriber', 'email')
                    ->ignore($subscriberId, 'subscriber_id'),
            ],

            'dob' => 'sometimes|required|date',
            'gender' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|nullable|string|max:255',
        ];
    }
}