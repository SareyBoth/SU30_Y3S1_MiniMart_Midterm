<?php

namespace App\Models;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;
    protected $table = 'categories';
    protected $fillable = ['name', 'image', 'description', 'status'];
    // Category.php
    public function statusRelation()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
}
