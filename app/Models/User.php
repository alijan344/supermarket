<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $primaryKey = 'employee_id';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'employee_id',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
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