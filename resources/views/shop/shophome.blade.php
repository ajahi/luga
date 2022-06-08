
@extends('layouts.shop')
@section('title')
    Luuga Luxury Fashion Home
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
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="index.html">
                                <img src="/images1/logo/logo1.png" alt="logo">
                            </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
                    </div>
                    <ul class="sidebar__thumd">
                        <li><a href="#"><img src="images1/sidebar-img/1.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/2.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/3.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/4.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/5.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/6.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/7.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images1/sidebar-img/8.jpg" alt="sidebar images"></a></li>
                    </ul>
                   
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->

            @include('cart')
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Feature Product -->
        <section class="categories-slider-area bg__white">
            <div class="container">
                <div class="row">
                    <!-- Start Left Feature -->
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                        <!-- Start Slider Area -->
                        <div class="slider__container slider--one">
                            <div class="slider__activation__wrap owl-carousel owl-theme">
                                <!-- Start Single Slide -->
                                @foreach($slider as $slider)
                                <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url({{$slider->url()}}) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>New Product <span class="text--theme">{{$slider->title}}</span></h1>
                                                    <div class="slider__btn">
                                                        <a class="htc__btn" href="/shop">shop now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- End Single Slide -->
                                <!-- Start Single Slide -->
                                
                               
                                <!-- End Single Slide -->
                            </div>
                        </div>
                        <!-- Start Slider Area -->
                    </div> 

                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                        <div class="categories-menu mrg-xs">
                            <div class="category-heading">
                           
                               <h3> Browse Categories</h3>
                            </div>
                            <div class="category-menu-list">
                                <ul>   
                                @foreach($sidemenu as $sidemenu)                             
                                   <li><a ><img alt="" src="images1/icons/thum2.png">{{$sidemenu->title}}   
                                   @if(count($sidemenu->children) > 0)
                                   <i class="fas fa-angle-right right"></i></a>
                                        <div class="category-menu-dropdown">
                                            <div class="category-part-1 category-common mb--30">
                                                <h4 class="categories-subtitle"> {{$sidemenu->title}}</h4>
                                                <ul>
                                                    @foreach($sidemenu->children as $children)
                                                    <li><a href="/shop-category/{{$children->slug}}"> {{$children->title}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>                                                                                    
                                        </div>                                 
                                    @endif
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Left Feature -->

                    <!--  shopheader ma xa agade ko tag -->
                </div>   
            </div>
        </section>
        <!-- End Feature Product -->
        <!-- Focus ad -->
        <div class="only-banner ptb--100 bg__white">
            <div class="container">
                <div class="only-banner-img">
                    <a href="shop-sidebar.html"><img src="/images1/new-product/luga.png" alt="new product"></a>
                </div>
            </div>
        </div><!-- end focus ad -->
        
        <section class="featured_products">
            <div class="container">
                <div class="row">
                <h2 class="heading"><span>Featured</span> Products</h2>
                </div>
                <div class="row">
                @forelse($featured as $product)
                    <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                        <div class="product">
                            <div class="product__inner">
                                <div class="pro__thumb">
                                    <a class='detail-product' value='{{$product->slug}}'>
                                                               
                                     <p></p>
                                    <img src="{{$product->url()}}" alt="product images">
                                    </a>
                                </div>
                            <div class="product__hover__info">
                             <ul class="product__action">
                                <li><a title="Quick View" class="quick-view modal-view detail-link detail-product"   value='{{$product->slug}}'><span class="ti-eye"></span></a></li>
                                @if($product->quantity < 0)

                                @else
                                <li><a title="Add To Cart" value='{{$product->id}}' class='button' ><span class="ti-shopping-cart"></span></a></li>
                                @endif                                    
                            </ul>
                        </div>
                    </div>
                    <div class="product__details">
                    <h2><a class='detail-product' value='{{$product->slug}}'>{{ucwords($product->title)}}</a></h2>
                    <ul class="product__price">
                    @if($product->discount)
                        <li class="old__price">Rs.{{$product->sell_price}}</li>
                        <li class="new__price">Rs.{{$product->sell_price*(1-$product->discount/100)}}</li>
                    @else
                        <li class="new__price">Rs.{{$product->sell_price}}</li>
                    @endif
                    </ul>    
                </div>
            </div>
        </div>   
                    @empty
                    <div class="row">
                        <div class="product">
                            <div class="col-md-12">
                                <div class="product">
                                    <p>No items .</p>
                                </div>
                                                            
                            </div>
                        </div>
                    </div>
                @endforelse        
                    
                </div>
            </div>            
        </section><!-- end featured products-->
        <!-- Start Our Product Area -->
        <section class="htc__product__area bg__white mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-style-tab">
                            <div class="product-tab-list">
                                <!-- Nav tabs -->
                                <ul class="tab-style" role="tablist">
                                    <li class="active">
                                        <a href="#home1" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Latest </h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#home2" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Best sale</h4>
                                            </div>
                                        </a>
                                    </li>
                                 
                                    <li>
                                        <a href="#home3" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Discount Sale</h4>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content another-product-style jump">
                                <div class="tab-pane active" id="home1">
                                    <div class="row">
                                        <div class="product-slider-active owl-carousel">
                                        @forelse($latest as $product)
                                            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a class='detail-product' value='{{$product->slug}}'>
                                                               
                                                                <p></p>
                                                                <img src="{{$product->url()}}" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                            <li><a title="Quick View" class="quick-view modal-view detail-link detail-product"   value='{{$product->slug}}'><span class="ti-eye"></span></a></li>
                                                            @if($product->quantity < 0)

                                                             @else
                                                             <li><a title="Add To Cart" value='{{$product->id}}' class='button' ><span class="ti-shopping-cart"></span></a></li>
                                                            @endif 
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__details">
                                                        <h2><a class='detail-product' value='{{$product->slug}}'>{{ucwords($product->title)}}</a></h2>
                                                        <ul class="product__price">
                                                            @if($product->discount)
                                                                <li class="old__price">Rs.{{$product->sell_price}}</li>
                                                                <li class="new__price">Rs.{{$product->sell_price*(1-$product->discount/100)}}</li>
                                                            @else
                                                            <li class="new__price">Rs.{{$product->sell_price}}</li>
                                                            @endif
                                                        </ul>    
                                                    </div>
                                                </div>
                                            </div>   
                                            @empty
                                                <div class="row">
                                                    <div class="product">
                                                        <div class="col-md-12">
                                                            <div class="product">
                                                                <p>No items .</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforelse                                                                                                                                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="home2">
                                    <div class="row">
                                        <div class="product-slider-active owl-carousel">
                                        @forelse($bestsale as $product)
                                            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a class='detail-product' value='{{$product->slug}}'>
                                                               
                                                                <p></p>
                                                                <img src="{{$product->url()}}" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                            <li><a title="Quick View" class="quick-view modal-view detail-link detail-product"   value='{{$product->slug}}'><span class="ti-eye"></span></a></li>
                                                            @if($product->quantity < 0)

                                                             @else
                                                             <li><a title="Add To Cart" value='{{$product->id}}' class='button' ><span class="ti-shopping-cart"></span></a></li>
                                                            @endif 
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__details">
                                                        <h2><a class='detail-product' value='{{$product->slug}}'>{{ucwords($product->title)}}</a></h2>
                                                        <ul class="product__price">
                                                            @if($product->discount)
                                                                <li class="old__price">Rs.{{$product->sell_price}}</li>
                                                                <li class="new__price">Rs.{{$product->sell_price*(1-$product->discount/100)}}</li>
                                                            @else
                                                            <li class="new__price">Rs.{{$product->sell_price}}</li>
                                                            @endif
                                                        </ul>    
                                                    </div>
                                                </div>
                                            </div>   
                                            @empty
                                                <div class="row">
                                                    <div class="product">
                                                        <div class="col-md-12">
                                                            <div class="product">
                                                                <p>No items .</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforelse                                                                                                                       
                                        </div>
                                    </div>
                                </div> 
                                <div class="tab-pane" id="home3">
                                    <div class="row">
                                        <div class="product-slider-active owl-carousel">
                                        @forelse($onsale as $product)
                                            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a class='detail-product' value='{{$product->slug}}'>
                                                               
                                                                <p></p>
                                                                <img src="{{$product->url()}}" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                            <li><a title="Quick View" class="quick-view modal-view detail-link detail-product"   value='{{$product->slug}}'><span class="ti-eye"></span></a></li>
                                                            @if($product->quantity < 0)

                                                             @else
                                                             <li><a title="Add To Cart" value='{{$product->id}}' class='button' ><span class="ti-shopping-cart"></span></a></li>
                                                            @endif 
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__details">
                                                        <h2><a class='detail-product' value='{{$product->slug}}'>{{ucwords($product->title)}}</a></h2>
                                                        <ul class="product__price">
                                                            @if($product->discount)
                                                                <li class="old__price">Rs.{{$product->sell_price}}</li>
                                                                <li class="new__price">Rs.{{$product->sell_price*(1-$product->discount/100)}}</li>
                                                            @else
                                                            <li class="new__price">Rs.{{$product->sell_price}}</li>
                                                            @endif
                                                        </ul>    
                                                    </div>
                                                </div>
                                            </div>   
                                            @empty
                                                <div class="row">
                                                    <div class="product">
                                                        <div class="col-md-12">
                                                            <div class="product">
                                                                <p>No items .</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforelse   
                                                                       
                                        </div>
                                    </div>
                                </div>                                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Product Area -->
        <!-- Testimonials section -->
        <section class="site_testimonials">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading"><span>Our Happy</span> Clients</h2>
                </div>
            </div>
            <!-- testimonials div -->
            <div id="testim" class="testim">
                <div class="testim-cover">
                    <div class="wrap">

                        <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                        <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                        <ul id="testim-dots" class="dots">
                        @foreach($testimonial as $count)
                            <li class="dot active"></li>
                        @endforeach
                        </ul>
                        <div id="testim-content" class="cont">
                            <!-- testimonials -->
                            @foreach($testimonial as $testy)
                            <div class="active">
                                <div class="img"><img src='{{$testy->url()}}' alt=""></div>
                                <h2>{{$testy->title}}</h2>
                                <p>{{$testy->description}}</p>                    
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- end testimonials div -->
            </div>
        </section>
        
        <!-- end testimonials section -->
        <!-- Start Blog Area -->
        <section class="site_blogs">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2 class="heading"><span>Our</span> Blogs <span><a href="/our-blogs">view all</a></span></h2>
                </div>
            </div>
           
            <div class="row">
            @foreach($blogs as $blogs)
                <div class="col-sm-12 col-md-3">
                    <div class="blog">
                        <a href='blog/{{$blogs->slug}}'>
                            <img src="{{$blogs->url()}}" alt="image">
                            <span><i class="fas fa-calendar-alt" style="margin-right:4px;"></i>{{$blogs->created_at}}</span>
                            <h4>{{$blogs->title}}</h4>
                            <p>{{$blogs->description}}</p>
                        </a>
                    </div>
                </div>
                
                @endforeach
                
            </div>
        </section><!-- end blogs section -->
@endsection

