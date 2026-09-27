<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $primaryKey = 'sale_id';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'sale_date',
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