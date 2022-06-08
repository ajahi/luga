
@extends('layouts.shop')
@section('title')
Shree Santoshi Mata Hastakala
@endsection

@section('sidemenu')
<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>

$(document).ready(function(){
    $('.button').click(function(){
        var pro_Id = $(this).attr('value');
            $.ajax({
            type:'get',
            cache:false,
            url:'<?php echo url('/add-to-cart');?>/'+ pro_Id,
            success:function(response){
               var resp=response;
                
                location.reload(true);
            
              }
        });
        
    }); 
   
   
   
   
});

</script>


<div class="container">
    @include('flash') 
</div>


<div class="shopping__cart"> 
                <div class="shopping__cart__inner">          
                    <div class="offsetmenu__close__btn">
                    <h2 class="offset-title">Cart</h2>
                        <a href="#"><i class="fas fa-angle-left right"></i></a>
                    </div>                   
                    @if(Session::has('cart'))
                    <div class="shp__cart__wrap">        
                        <div class="shp__single__product">                     
                         <ul>
                            @foreach($items as $item)
                                <li>
                                    <div class="shp__pro__thumb">
                                    <a href="#">
                                        <img src="{{$item['item']->url()}}" alt="{{$item['item']['title']}}">
                                    </a>
                                    </div>  
                                    <div class="shp__pro__details">
                                        <h2 id='itemName'><a href="product-details.html"><strong>{{$item['item']['title']}}</strong></a></h2>
                                        <div style="inline">
                                            <span class="quantity">X {{$item['qty']}}</span>
                                            <!-- <span class='quantity'><a href="/reduce/{{$item['item']['id']}}" title="Reduce this item"><i class="fas fa-minus-square"></i></a></span>
                                            <span class='quantity'><a href="/increase/{{$item['item']['id']}}" title="Increase this item"><i class="fas fa-plus-square"></i></a></span> -->
                                        </div>
                                        
                                        <span class="shp__price">Rs. {{$item['item']['purchase_price']}}</span>                                     
                                    </div>
                                    <div class="remove__btn">
                                        <form 
                                        method="get"
                                        action="/remove/{{$item['item']['id']}}" 
                                        title="Remove this item" >
                                        <button class='btn btn-outline-light btn-lg'><i class="ti-trash right"></i></button>
                                        
                                        </form>
                                        <!-- <a href="/remove/{{$item['item']['id']}}" title="Remove this item"><i class="ti-trash right"></i></a> -->
                                    </div>
                                </li>
                            @endforeach
                            </ul>                      
                        </div>
                       
                        <ul class="shoping__total">
                            <li class="subtotal">Subtotal:</li>
                            <li class="total__price">Rs. {{$totalPrice}}</li>
                        </ul>
                    </div>
                    
                    @else
                    <div class="shp__cart__wrap">
                        <p>No Items in the cart.</p>
                    </div>
                    @endif

                   @if(Session::has('cart'))
                    <ul class="shopping__btn">
                    
                        <li><a class='removebtn'>Empty Cart</a></li>
                        <li class="shp__checkout"><a href="/checkout">Checkout</a></li>
                    
                    </ul>
                   @endif
                </div>
            </div>




     <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/images1/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Product Details</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Product Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

           <section class="htc__product__details pt--120 pb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    
                        <div class="product__details__container">
                            <!-- Start Small images -->
                            @if(count($product->getMedia('images')) > 1)
                            <ul class="product__small__images" role="tablist">

                            @foreach($product->getMedia('images') as $media)
                                <li role="presentation" class="pot-small-img active">
                                    <a href="#img-tab-1" role="tab" data-toggle="tab">
                                        <img src="{{$media->geturl()}}" alt="small-image">
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                            <!-- End Small images -->
                            @else
                            <div class="product__big__images">
                                <div class="portfolio-full-image tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active product-video-position" id="img-tab-1">
                                        <img src="{{$product->url()}}" alt="full-image">
                                       
                                    </div>
                                    
                                </div>
                            </div>
                            @endif
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                        <div class="htc__product__details__inner">
                            <div class="pro__detl__title">
                                <h2>{{$product->title}}</h2>
                            </div>
                            <!-- <div class="pro__dtl__rating">
                                <ul class="pro__rating">
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                                <span class="rat__qun">(Based on 0 Ratings)</span>
                            </div> -->
                            <div class="pro__details">
                                <p>{{$product->description}} </p>
                            </div>
                            <ul class="pro__dtl__prize">
                            @if($product->discount)
                                <li class="old__prize">Rs. {{$product->sell_price}}</li>
                                <li>Rs.{{$product->sell_price*(1-$product->discount/100)}}</li>
                            @else
                                <li>Rs. {{$product->sell_price}}</li>
                            @endif
                                
                            </ul>
                            <!-- <div class="pro__dtl__color">
                                <h2 class="title__5">Choose Colour</h2>
                                <ul class="pro__choose__color">
                                    <li class="red"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                    <li class="blue"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                    <li class="perpal"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                    <li class="yellow"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                </ul>
                            </div> -->
                            <!-- <div class="pro__dtl__size">
                                <h2 class="title__5">Size</h2>
                                <ul class="pro__choose__size">
                                    <li><a href="#">xl</a></li>
                                    <li><a href="#">m</a></li>
                                    <li><a href="#">ml</a></li>
                                    <li><a href="#">lm</a></li>
                                    <li><a href="#">xxl</a></li>
                                </ul>
                            </div> -->
                            <div class="product-action-wrap">
                                <div class="prodict-statas"><span>Quantity :</span></div>
                                <div class="product-quantity">
                                    <form id='myform' method='POST' action='#'>
                                        <div class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="01">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            @if($product->quantity < 0)
                            <div class="pro__details">
                                <p>Currently the stock are empty of this product.</p>
                            </div>
                            @else
                            <ul class="pro__dtl__btn">
                                <li class="buy__now__btn"><a href="/buynow/{{$product->id}}">Buy now</a></li>
                                <li class="buy__now__btn"><a class='button' value='{{$product->id}}'>Add To Cart</a></li>
                            </ul>
                            @endif
                            
                            <div class="pro__social__share">
                                <h2>Share :</h2>
                                <ul class="pro__soaial__link">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection