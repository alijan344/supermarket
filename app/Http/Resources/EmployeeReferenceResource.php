<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeReferenceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reference_id' => $this->reference_id,
            'employee_id' => $this->employee_id,
            'reference_name' => $this->reference_name,
            'organization' => $this->organization,
            'position' => $this->position,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}