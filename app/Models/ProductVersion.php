<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    protected $table = 'product_version';
    protected $fillable = ['id_product_attribute_types', 'id_product', 'key', 'type', 'value'];
}