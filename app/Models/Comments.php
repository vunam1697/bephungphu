<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trails\ModelScopes;

class Comments extends Model
{
    use ModelScopes;
    
    protected $table = 'comments';


    public function Customers()
    {
   		return $this->hasOne('App\Models\Customers', 'id', 'id_customers');
    }

    public function Product()
    {
    	return $this->hasOne('App\Models\Products', 'id', 'id_product');
    }


    public function getChild()
    {
        return $this->where('parent_id', $this->id)->get();
    }


    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

}
