<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;
    protected $table = 'products';
    protected $fillable = ['name', 'image', 'description', 'status', 'price','stock_quantity','category_id', 'sub_category_id', 'product_id'];
    // Category.php
    public function statusRelation()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subCategoryRelation()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
    
}
