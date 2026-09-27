<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Product;

class Buy extends Model
{
    use HasFactory;
    protected $table = 'buy';

    protected $primaryKey = 'buy_id';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'product_name',
        'category',
        'description',
        'quantity',
        'unitprice',
        'totalprice',
        'supplier_id',
        'employee_id',
        'buy_date',
        'manufacture_date',
        'expire_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}