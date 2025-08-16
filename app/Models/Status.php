<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // If your statuses table does not have `created_at` and `updated_at` columns, disable timestamps:
    public $timestamps = true;

    protected $table = 'statuses';

    // If your table is named something other than 'statuses', specify it:
    // protected $table = 'status'; // only if table name is not 'statuses'

    // You can specify fillable if you want mass assignment:
    // protected $fillable = ['name'];
}
