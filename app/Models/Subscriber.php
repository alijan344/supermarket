<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Subscriber extends Model
{
    use HasFactory;
    protected $table = 'subscriber';

    protected $primaryKey = 'subscriber_id';

    protected $fillable = [
        'subscriber_name',
        'image',
        'phone',
        'email',
        'dob',
        'gender',
        'address',
    ];

    public function orders()
    {
        return $this->hasMany(
            Order::class,
            'subscriber_id',
            'subscriber_id'
        );
    }
}