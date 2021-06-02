<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table = 'filter';
    protected $fillable = ['name','type', 'content', 'category_id'];
}
