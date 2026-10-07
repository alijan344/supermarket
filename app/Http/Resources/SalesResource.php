<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sale_id' => $this->sale_id,
            'employee_id' => $this->employee_id,
            'sale_date' => $this->sale_date,
        ];
    }
}