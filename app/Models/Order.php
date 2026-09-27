<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscriber;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    public $timestamps = false;

    protected $fillable = [
        'subscriber_id',
        'order_date',
    ];

    public function subscriber()
    {
        return $this->belongsTo(
            Subscriber::class,
            'subscriber_id',
            'subscriber_id'
        );
    }
}