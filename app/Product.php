<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Http\Resources\Media as MediaResource;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable=[
        'title',
        'description',
        'slug',
        'purchase_price',
        'sell_price',
        'user_id',
        'counts',
        'quantity',
        'position',
        'status',
        'featured',
        'discount',
        'offer',
        'InStock'
    ];

    public function categories() {
        return $this->belongsToMany('App\ProductCategory','products_product_categories')->withPivot('product_id');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    public  function photo(){
        if (count($this->getMedia('')) > 0) {
            return MediaResource::collection($this->getMedia(''));
        }

    }
    public function tags(){
        return $this->belongsToMany('App\Tag','product_tag')->withPivot('product_id');
    }
   public function images(){
    if (count($this->getMedia('')) > 0) {
        return $this->getMedia('');
    }
    return 0;
   }
   
   public function photu(){
       return $this->getMedia('');
   }
   public function url(){
       return $this->getFirstMediaUrl('');
   }
   public function price(){
       if(($this->discount)==null){
           return $this->sell_price;
       }
       return (1 - $this->discount/100)*$this->sell_price;
   }
   
}
