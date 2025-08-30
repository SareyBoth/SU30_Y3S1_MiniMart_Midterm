<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = true;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price',];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with the order item.
     */
    public function product()
    {
        // This defines the relationship: An OrderItem belongs to a Product.
        return $this->belongsTo(Product::class);
    }
}
