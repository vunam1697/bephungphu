<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trails\ModelScopes;
use Conner\Tagging\Taggable;

class Products extends Model
{
    use SoftDeletes, ModelScopes, Taggable;
    protected $table = 'products';

    protected $dates = ['deleted_at'];

    protected $fillable = ['sku', 'name', 'slug', 'image', 'sort_desc', 'content', 'specifications', 'title_attributes' , 'products_version', 'title_desc_gift', 'end_date_apply_gift', 'content_gift','regular_price','sale_price','sale', 'is_hot','is_flash_sale', 'is_apply_gift', 'status', 'brand_id', 'meta_title', 'is_price_shock', 'is_selling',
    	'meta_description', 'meta_keyword', 'order_sale_page', 'time_priority','price_priority', 'content_services_warranty', 'warranty_parameter'
    ];

    public function ProductImage()
    {
        return $this->hasMany('App\Models\ProductImage', 'id_product', 'id'); 
    }

    public function ProductQuestions()
    {
        return $this->hasMany('App\Models\ProductQuestions', 'id_product', 'id'); 
    }

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'product_category', 'id_product', 'id_category');
    }

    public function CheckApplyGift()
    {
        if($this->is_apply_gift == 1 && !empty($this->end_date_apply_gift)){
            $end_date = $this->end_date_apply_gift;
            $now = \Carbon\Carbon::now();
            $end_date = \Carbon\Carbon::parse(\Carbon\Carbon::parse($end_date)->format('d-m-yy').'23:59:59');
            if($end_date->gt($now)){
                return true;
            }
        }
        return false;
    }


    public function CheckPricePriority()
    {
        if(!empty($this->price_priority) && !empty($this->time_priority)){
            $time_priority = explode(' - ', $this->time_priority);
            $now = \Carbon\Carbon::now();
            $time_priority[0] = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $time_priority[0].'1:00:00');
            $time_priority[1] = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $time_priority[1].'23:59:59');
            return $now->isBetween($time_priority[0], $time_priority[1], false);
        }
    }


    public function Comments()
    {
        return $this->hasMany('App\Models\Comments', 'id_product', 'id')->where('status', 1);
    }

    public function scopeFilter($query)
    {
        if (request('gia')) {
            $price = request('gia');
            $price = explode('-', $price);
            $query->whereBetween('regular_price', array(@$price[0], @$price[1]));
        }if(request('brand')){
            $query->where('brand_id', request('brand'));
        }
        return $query;
    }

    public function scopeSort($query)
    {
        if (request('order')) {
            $order = request('order');
            $order = explode('-', $order);
            if($order[0] == 'price'){
                $query->orderBy('regular_price', $order[1]);
            }else{
                $query->where('is_selling', 1)->orderBy('is_selling', 'desc');
            }
        }else{
            $query->orderBy('created_at', 'desc');
        }
        return $query;
    }


    public function Brand()
    {
        return $this->belongsTo('App\Models\Categories', 'brand_id', 'id');
    }


    public function ProductAttributes()
    {
        return $this->hasMany('App\Models\ProductAttributes', 'id_product', 'id'); 
    }

    public function ProductVersion()
    {
        return $this->hasMany('App\Models\ProductVersion', 'id_product', 'id'); 
    }


    public function ProductGift()
    {
        return $this->hasMany('App\Models\ProductGift', 'id_product', 'id')->orderBy('created_at', 'ASC'); 
    }
    
    

}
