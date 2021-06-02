<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    public function Products()
    {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id')->withTrashed();
    }
}
