<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unitprice',
        'totalprice',
        'remark',
    ];

    public function order()
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'order_id'
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