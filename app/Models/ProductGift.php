<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGift extends Model
{
    protected $table = 'product_gift';
    protected $fillable = ['id_product', 'desc', 'value', 'type'];
}