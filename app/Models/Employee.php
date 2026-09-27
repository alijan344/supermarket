<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\EmployeeReference;
use App\Models\Buy;
use App\Models\Sale;
use App\Models\Expense;


class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'firstname',
        'lastname',
        'position',
        'education',
        'phone',
        'email',
        'address',
        'image',
        'gender',
        'hire_date',
        'dob',
        'marital_status',
        'salary',
        'shift',
    ];

    public function references()
    {
        return $this->hasMany(EmployeeReference::class, 'employee_id', 'employee_id');
    }

    public function buys()
    {
        return $this->hasMany(Buy::class, 'employee_id', 'employee_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'employee_id', 'employee_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'employee_id', 'employee_id');
    }
}