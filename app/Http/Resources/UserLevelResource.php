<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLevelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->employee_id,
            'head' => $this->head,
            'hr' => $this->hr,
            'inventory' => $this->inventory,
            'finance' => $this->finance,
        ];
    }
}