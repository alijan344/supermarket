<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'buy_id' => $this->buy_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'category' => $this->category,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'unitprice' => $this->unitprice,
            'totalprice' => $this->totalprice,
            'supplier_id' => $this->supplier_id,
            'employee_id' => $this->employee_id,
            'buy_date' => $this->buy_date,
            'manufacture_date' => $this->manufacture_date,
            'expire_date' => $this->expire_date,
        ];
    }
}