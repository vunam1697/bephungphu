<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeTypes extends Model
{
    protected $table = 'product_attribute_types';
    protected $fillable = [ 'name', 'template', 'type', 'slug' ];
}
