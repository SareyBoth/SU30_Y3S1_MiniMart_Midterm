<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = true;
    protected $table = 'orders';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price',];
}
