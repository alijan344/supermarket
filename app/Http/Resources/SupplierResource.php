<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'supplier_id' => $this->supplier_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'supplier_type' => $this->supplier_type,
            'location' => $this->location,
        ];
    }
}