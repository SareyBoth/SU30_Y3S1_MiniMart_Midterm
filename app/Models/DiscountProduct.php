<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discount_products';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'discount_type',
        'discount_value',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    /**
     * Get the product that this discount belongs to.
     */
    public function product()
    {
        // This defines the relationship: A DiscountProduct belongs to a Product.
        return $this->belongsTo(Product::class, 'product_id');
    }
}

