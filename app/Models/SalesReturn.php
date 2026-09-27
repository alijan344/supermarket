<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class SalesReturn extends Model
{
    use HasFactory;
    protected $table = 'sales_return';

    protected $primaryKey = 'return_id';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'return_date',
        'reason',
        'quantity',
        'unitprice',
        'totalprice',
    ];

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'product_id'
        );
    }
}