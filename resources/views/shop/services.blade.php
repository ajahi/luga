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
               loaditems(resp);
              }
        });
        
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
   
   
    function loaditems(data){
        var name=document.getElementById('itemName');
        var duta=data.items[3].item.title;
        console.log(duta);
    }
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
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
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
            @include('cart')
        <!-- End Cart Panel -->
        </div>
        <!-- Breadcrumb sectio  -->
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Services</h2>
                        <nav class="bradcaump-inner">              
                            <nav class="" role="navigation" aria-label="breadcrumbs">
                                <ul class="breadcrumb-list">
                                    <li>
                                    <a href="/" title="Back to the home page">Home</a>
                                    </li>
                                    <li> 
                                        <span>Services</span>
                                    </li>
                                </ul>
                            </nav>
                        </nav>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        <!-- end breadcrumb section -->
     
       
                    
         <!-- services section -->
         <section class="services">
             <div class="container">
                <div class="row">
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
                    <div class="service">
                        <span class="effect-1" aria-hidden="true">
                        <i class="fas fa-check-square"></i>
                        </span>
                            <div class="services-text">
                                <h4>Quality Work</h4>
                                <p>We Believe In Quality Work &amp; 100% Satisfaction Of Our Customers.</p>
                            </div>
                    </div>
				</div>
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
                   <div class="service">
                   <span class="effect-1" aria-hidden="true">
                    <i class="fas fa-truck"></i>
                    </span>
                        <div class="services-text">
                            <h4>Free Delivery</h4>
                            <p>We Have The Service Of Free Delivery Of Our Products.</p>
                        </div>
                   </div>
				</div>
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
					<div class="service">
                        <span class="effect-1" aria-hidden="true">
                        <i class="fas fa-headset"></i>
                        </span>
                        <div class="services-text">
                            <h4>24 Hour Support</h4>
                            <p>Our Staffs Are 24hrs Available For Customers Support.</p>
                        </div>
                    </div>
				</div>
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
					<div class="service">
                        <span class="effect-1" aria-hidden="true">
                        <i class="fas fa-money-bill-wave"></i>
                        </span>
                        <div class="services-text">
                            <h4>100% Money Back</h4>
                            <p>We Guarantee 100% Money Back In case Of Any Defects Of Our Products.</p>
                        </div>
                    </div>
				</div>
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
					<div class="service">
                        <span class="effect-1" aria-hidden="true">
                            <i class="fas fa-gift"></i>
                        </span>
                        <div class="services-text">
                            <h4>Packaging</h4>
                            <p>The Packaging Of Our Products Is Done With High Maintenance.</p>
                        </div>
                    </div>
				</div>
                <div class="col-sm-12 col-md-4 services-grid services-grid1">
					<div class="service">
                        <span class="effect-1" aria-hidden="true">
                            <i class="fas fa-briefcase"></i>
                        </span>
                        <div class="services-text">
                            <h4>Fast Delivery</h4>
                            <p>The Products Are Generally Delivered At Faster Speed..</p>
                        </div>
                    </div>
				</div>
                </div>
             </div>
         </section>
         <!-- end services -->

       
      
                    
                    
                
@endsection