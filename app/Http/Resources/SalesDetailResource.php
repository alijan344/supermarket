<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sale_detail_id' => $this->sale_detail_id,
            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unitprice' => $this->unitprice,
            'totalprice' => $this->totalprice,
            'discount' => $this->discount,
            'totalamount' => $this->totalamount,
        ];
    }
}