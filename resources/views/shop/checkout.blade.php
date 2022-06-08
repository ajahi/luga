
@extends('layouts.shop')
@section('title')
Shree Santoshi Mata Hastakala
@endsection

@section('sidemenu')
<body> 
<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$(document).ready(function(){
    $('.reduce').click(function(){
        var pro_id=$(this).attr('value');
        $.ajax({
            type:'get',
            url:'<?php echo url('/reduce');?>/'+ pro_id,
            success:function(){
               
                location.reload(true);
            }
        });
    });
    $('.increase').click(function(){
        var pro_id=$(this).attr('value');
        $.ajax({
            type:'get',
            url:'<?php echo url('/increase');?>/'+ pro_id,
            success:function(){
                
                location.reload(true);
            }
        })
    });
});
</script>
<div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="index.html">
                                <img src="images1/logo/logo1.png" alt="logo">
                            </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
                    </div>
                  
                    
                  
                </div>
            </div>

        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Checkout</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
        <section class="our-checkout-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="ckeckout-left-sidebar">
                            <!-- Start Checkbox Area -->
                            <div class="checkout-form">
                                <h2 class="section-title-3">Details</h2>
                                <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>                                        
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Sub-total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    
                                    @foreach($cart->items as $cart)
                                    <tbody>                                       
                                        <tr>
                                            <td class="product-name"><span class='amount'>{{$cart['item']['title']}}</span></td>
                                            <td class="product-price"><span class="amount">{{$cart['item']->price()}}</span></td>
                                            <td class="product-quantity"><span class="amount" >
                                            {{$cart['qty']}}
                                            <a title="Reduce this item" value="{{$cart['item']['id']}}" class='reduce'><i class="fas fa-minus-square"></i></a>
                                            <a title="Increase this item" value="{{$cart['item']['id']}}" class='increase'><i class="fas fa-plus-square"></i></a>
                                            </span></td>
                                            <td class="product-subtotal">{{$cart['price']}}</td>
                                            <td class="product-remove"><a href="remove/{{$cart['item']['id']}}">X</a></td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    
                                </table>
                               
                            </div>
                            <div class="section">
                                <h2 class="section-title-3 ">Subtotal : <span class="subtotal">RS {{Session::get('cart')->totalPrice}}</span> </h2> 
                                <!-- <h2 class="section"></h2> -->
                            </div>
                            
                                <div class="checkout-form-inner">
                                    <form action="/order" method="POST">
                                    @csrf
                                        <div class="single-checkout-box">
                                            <input type="text" placeholder="First Name*" name='firstname' required>
                                            <input type="text" placeholder="Last Name*" name='lastname' required>
                                        </div>
                                        <div class="single-checkout-box">
                                            <input type="email" placeholder="Email*" name='email' required>
                                            <input type="number" placeholder="Phone*" name='phone' required>
                                        </div>
                                        <div class="single-checkout-box">
                                            <input type="text" placeholder="Address *" name='address' required>
                                            
                                        </div>
                                        <div class="our-payment-sestem">
                                            <button class="ts-btn  btn-large btn btn-checkout" type='submit'> CONFIRM </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Checkbox Area -->
                            <!-- Start Payment Box -->
                          
                            <!-- End Payment Box -->
                            <!-- Start Payment Way -->
                            
                            <!-- End Payment Way -->
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="checkout-right-sidebar">
                            <div class="our-important-note">
                                <h2 class="section-title-3">Note:</h2>
                                <p>We accept cash on delivery.Happy shopping.</p>                
                                    </div>
                            <div class="puick-contact-area mt--60">
                                <h2 class="section-title-3">Quick Contract</h2>
                                <a href="phone:+8801722889963">+012 345 678 102 </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection