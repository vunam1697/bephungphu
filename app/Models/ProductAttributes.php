<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $table = 'product_attributes';
    protected $fillable = ['id_product_attribute_types', 'id_product', 'key', 'type', 'value'];
}
