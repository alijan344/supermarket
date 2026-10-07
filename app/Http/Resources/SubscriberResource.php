<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'subscriber_id' => $this->subscriber_id,
            'subscriber_name' => $this->subscriber_name,
            'image' => $this->image,
            'phone' => $this->phone,
            'email' => $this->email,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'address' => $this->address,
        ];
    }
}