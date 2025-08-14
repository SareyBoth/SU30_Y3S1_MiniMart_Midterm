<?php

namespace App\Models;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = ['name', 'image', 'description', 'status', 'price','stock_quantity','category_id'];
    // Category.php
    public function statusRelation()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
    
}
