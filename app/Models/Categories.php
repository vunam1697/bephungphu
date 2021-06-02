<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [ 'name','slug','parent_id','image', 'meta_title', 'meta_description', 'meta_keyword', 'type', 'meta_orthers', 'banner', 'link_footer', 'meta_banner', 'logo', 'order', 'is_using_banner_big', 'content_banner_big'];


    public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

    public function Posts()
    {
        return $this->belongsToMany('App\Models\Posts', 'post_category', 'id_category', 'id_post');
    }
}
