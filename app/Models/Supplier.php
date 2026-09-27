<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buy;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';

    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'supplier_type',
        'location',
    ];

    public function buys()
    {
        return $this->hasMany(
            Buy::class,
            'supplier_id',
            'supplier_id'
        );
    }
}