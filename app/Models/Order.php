<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'order_number', 'status', 'total_amount', 'shipping_address', 'payment_method', 'payment_status', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
        // This defines the relationship: An Order has many OrderItems.
        return $this->hasMany(OrderItem::class);
    }
}
