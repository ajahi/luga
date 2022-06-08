<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements HasMedia {

    use HasMediaTrait;
    /*use HasSlug;*/
    protected $fillable = [
        'title','slug', 'description','position','attributes'
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    /*public function getSlugOptions(): SlugOptions
    {
        // TODO: Implement getSlugOptions() method.
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator(env('SLUG',"-"));
    }*/
}
