<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable=['first_name','last_name','contact_number','status'];

    public function selldetail(){
        return $this->hasMany('App\SaleDetail','sell_id');

    }
    
}
