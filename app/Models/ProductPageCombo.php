<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPageCombo extends Model
{
    protected $table = 'product_pages_combo';
    protected $fillable = [ 'name', 'slug', 'content', 'image', 'meta_title','meta_description', 'meta_keyword' ];
}
