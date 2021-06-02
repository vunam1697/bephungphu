<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    use SoftDeletes;

    protected $table = 'coupons';


    protected $dates = ['deleted_at'];

    protected $fillable = ['code', 'name', 'desc', 'type', 'value', 'status', 'count' , 'condition', 'is_display_pages_cart'];
    
}
