<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_detail_id' => $this->order_detail_id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unitprice' => $this->unitprice,
            'totalprice' => $this->totalprice,
            'remark' => $this->remark,
        ];
    }
}