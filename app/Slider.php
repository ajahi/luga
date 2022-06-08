<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Slider extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = 'sliders';
    protected $hidden = [''];
    protected $fillable = [
        'title','description'
    ];
    protected $appends = ['featured'];
    public function url(){
        return $this->getFirstMediaUrl('');
    }

}
