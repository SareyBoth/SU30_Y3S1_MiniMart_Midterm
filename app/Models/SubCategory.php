<?php

namespace App\Models;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = true;
    protected $table = 'sub_categories';
    protected $fillable = ['name', 'image', 'category_id', 'description', 'status'];
    // Category.php
    public function statusRelation()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
