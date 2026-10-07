<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->order_id,
            'subscriber_id' => $this->subscriber_id,
            'order_date' => $this->order_date,
        ];
    }
}