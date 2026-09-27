<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Product;

class SalesDetail extends Model
{
    use HasFactory;
    protected $table = 'sales_detail';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unitprice',
        'totalprice',
        'discount',
        'totalamount',
    ];

    public function sale()
    {
        return $this->belongsTo(
            Sale::class,
            'sale_id',
            'sale_id'
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'product_id'
        );
    }
}