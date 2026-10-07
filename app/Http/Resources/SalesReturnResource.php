<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sales_return_id' => $this->sales_return_id,
            'product_id' => $this->product_id,
            'return_date' => $this->return_date,
            'reason' => $this->reason,
            'quantity' => $this->quantity,
            'unitprice' => $this->unitprice,
            'totalprice' => $this->totalprice,
        ];
    }
}