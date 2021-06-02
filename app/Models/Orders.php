<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $dates = ['deleted_at'];

    public function Customers()
    {
    	return $this->hasOne('App\Models\Customers', 'id', 'id_customers');
    }

    public function OrderDetail()
    {
    	return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }
}
