<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProductCategory extends Model
{
    
    protected $fillable = ['title', 'slug', 'description','parent_id','position'];

    public function children() {
        return $this->hasMany('App\ProductCategory','parent_id');
    }
    public function parent() {
        return $this->belongsTo('App\ProductCategory','parent_id');
    }
    public function products(){
        return $this->belongsToMany('App\Product','products_product_categories')->withPivot('product_category_id');
    }
    public function menu(){
        return $this->has('App\Menu');
    }
}
