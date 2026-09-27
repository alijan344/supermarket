<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class EmployeeReference extends Model
{
    use HasFactory;
    protected $table = 'employee_reference';

    protected $primaryKey = 'reference_id';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'reference_name',
        'organization',
        'position',
        'phone',
        'email',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}