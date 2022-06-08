<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cart;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {    //cart
        $oldCart=Session::get('cart');
        $cart= new Cart($oldCart);
        return view('shop.blogs',[
                //cart
                'items'=>$cart->items,
               'totalPrice'=>$cart->totalPrice
        ]);
    }
}
