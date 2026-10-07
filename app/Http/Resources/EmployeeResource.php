<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->employee_id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'position' => $this->position,
            'education' => $this->education,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'image' => $this->image,
            'gender' => $this->gender,
            'hire_date' => $this->hire_date,
            'dob' => $this->dob,
            'marital_status' => $this->marital_status,
            'salary' => $this->salary,
            'shift' => $this->shift,
        ];
    }
}