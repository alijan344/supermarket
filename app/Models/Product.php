<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buy;
use App\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'category',
        'unitprice',
        'quantity',
        'image',
        'store_date',
        'location',
    ];

    public function buys()
    {
        return $this->hasMany(
            Buy::class,
            'product_id',
            'product_id'
        );
    }

    public function orderDetails()
    {
        return $this->hasMany(
            OrderDetail::class,
            'product_id',
            'product_id'
        );
    }
}