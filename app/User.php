<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


//passport
use Laravel\Passport\HasApiTokens;

//entrust
use Zizaco\Entrust\Traits\EntrustUserTrait;


//media library

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;





class User extends Authenticatable implements HasMedia
{

    use EntrustUserTrait , HasApiTokens, Notifiable , HasMediaTrait ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');

    }

    public function post() {
        return $this->hasMany('App\Post');
    }

}
