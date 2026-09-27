<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expense';

    protected $primaryKey = 'expense_id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'amount',
        'currency',
        'pay_date',
        'employee_id',
        'receiver',
    ];

    public function employee()
    {
        return $this->belongsTo(
            Employee::class,
            'employee_id',
            'employee_id'
        );
    }
}