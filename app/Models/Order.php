<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'address', 'zip', 'city', 'total_price', 'payment_method', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
