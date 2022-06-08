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
    $('.detail-product').click(function(){
        var pro_Id = $(this).attr('value');
       $(location).attr('href','<?php echo url('/product-detail');?>/'+ pro_Id);
    });
    $('.removebtn').click(function(){
        
        $.ajax({
            type:'get',
            url:'<?php echo url('/newcart');?>',
            success:function(response){
              
                location.reload(true);
            }
        });
    });
   
   

});

</script>


<div class="container">
    @include('flash') 
</div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="/search" method="get">
                                    <input placeholder="Search here... " type="text" name='search'>
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="fas fa-times"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->

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
                                        <img src="{{$item['item']->url()}}" alt="product images">
                                    </a>
                                    </div>  
                                    <div class="shp__pro__details">
                                        <h2 id='itemName'><a class='detail-product' value='{{$item['item']['slug']}}'><strong>{{$item['item']['title']}}</strong></a></h2>
                                        <div style="inline">
                                            <span class="quantity">X {{$item['qty']}}</span>
                                            <!-- <span class='quantity'><a href="/reduce/{{$item['item']['id']}}" title="Reduce this item"><i class="fas fa-minus-square"></i></a></span>
                                            <span class='quantity'><a href="/increase/{{$item['item']['id']}}" title="Increase this item"><i class="fas fa-plus-square"></i></a></span> -->
                                        </div>
                                        
                                        <span class="shp__price">Rs. {{$item['item']->price()}}</span>                                     
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
            <!-- End Cart Panel -->
        </div>
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/images1/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">{{$procat->title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- End Bradcaump area -->
         @if($count > 0)
         <div class="container">
         <div class="row">
                <div class="product__list another-product-style">
                    @foreach($pro as $pro)
                   
                            <div class="col-md-3 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                            <a class='detail-product' value='{{$pro->slug}}'>
                                                <img src="{{$pro->url()}}" alt="product images">
                                            </a>
                                        </div>
                                        <div class="product__hover__info">
                                                <ul class="product__action">
                                                    <li><a title="Quick View" class="quick-view modal-view detail-link detail-product" value='{{$pro->slug}}' ><span class="ti-eye"></span></a></li>
                                                    @if($pro->quantity < 0)

                                                    @else
                                                    <li><a title="Add To Cart" value='{{$pro->id}}' class='button' ><span class="ti-shopping-cart"></span></a></li>
                                                    @endif
                                                         
                                                </ul>
                                        </div>
                                    </div>
                                    <div class="product__details portfolio-title text-center">
                                        <h2><a class='detail-product' value='{{$pro->slug}}'>{{ucwords($pro->title)}}</a></h2>
                                        <div class='product__price mx-2' >
                                        <ul class="product__price ">
                                                @if($pro->discount)
                                                    <li class="old__price ">Rs.{{$pro->sell_price}}</li>
                                                    <li class="new__price ">Rs.{{$pro->sell_price*(1-$pro->discount/100)}}</li>
                                                @else
                                                    <li class="new__price ">Rs.{{$pro->sell_price}}</li>
                                                @endif
                                            </ul> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                    @endforeach	                       
                    </div>		
                </div>
         </div>
        @else
        <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Sorry no items available for this category.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
@endsection