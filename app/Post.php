<?php

namespace App;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia {

    use HasMediaTrait;
    /*use Sluggable;*/
    protected $fillable = [
        'title','slug','description','icon','status','category_id', 'attributes','user_id','meta_description','counts'
    ];


    public function category() {
        return $this->belongsTo('App\Category');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
    public function url(){
        return $this->getFirstMediaUrl('');
    }
    

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    /*public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }*/

    /*public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator(env('SLUG',"-"));
    }*/

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(env('THUMB_WIDTH',150))
            ->height(env('THUMB_HEIGHT',150))
            ->performOnCollections('featured');

        $this->addMediaConversion('medium')
            ->width(env('MEDIUM_WIDTH',344))
            ->height(env('MEDIUM_HEIGHT',204))
            ->performOnCollections('featured');
    }


}
