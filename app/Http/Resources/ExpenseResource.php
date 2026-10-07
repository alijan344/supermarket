<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'expense_id' => $this->expense_id,
            'title' => $this->title,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'pay_date' => $this->pay_date,
            'employee_id' => $this->employee_id,
            'receiver' => $this->receiver,
        ];
    }
}