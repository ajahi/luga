
<footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                         <!-- Start Single Footer Widget -->
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <div class="ft__widget">
                                <div class="ft__logo">
                                    <a href="/">
                                        <img src="/images1/logo/logo1.png" alt="footer logo">
                                    </a>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                    
                                        <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-pin"></i>
                                        </div>
                                        <div class="address-text">
                                            <p>
                                             {{$categories['site'][0]->location}}</p>
                                        </div>
                                        </li>
                                        <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-email"></i>
                                        </div>
                                        <div class="address-text">
                                            <p>{{$categories['site'][0]->website}}</p>
                                        </div>
                                        </li>
                                        <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-phone-in-talk"></i>
                                        </div>
                                        <div class="address-text">
                                            <p>{{$categories['site'][0]->telephone}}</p>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="social__icon">
                                    <li><a href="{{$categories['site'][0]->facebook}}" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="{{$categories['site'][0]->twitter}}" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="{{$categories['site'][0]->instagram}}" target="_blank" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>
                                </ul>
                                
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-4 col-lg-4 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Categories</h2>
                                <ul class="footer-categories">
                               @foreach($categories['categories'] as $cat)
                                    
                                    <li><a href="/shop-category/{{$cat->slug}}">{{ucwords($cat->title)}}</a></li>
                                    
                                   
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-4 col-lg-4 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Infomation</h2>
                                <ul class="footer-categories">
                                    <li><a href="/about-us">About Us</a></li>
                                    <li class="drop"><a href="/our-gallery">Gallery</a></li>
                                    <li><a href="/our-blogs">Blogs</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Start Copyright Area -->

                <div class="htc__copyright__area">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner">
                        <div class="copyright ">
                        <p>© Copyright <a href="/">Luga</a> All Rights Reserved. &nbsp;&nbsp;Powered by:<a style="color:#ff4136;" href="#">Ajahi It Solutions</a></p>
                        </div>
                        
                        <ul class="footer__menu">                      
                        
                        <li><a href="/">Home</a></li>
                        
                        <li><a href="/shop">Product</a></li>
                        
                        <li><a href="/contact-us">Contact Us</a></li>
                        
                        </ul>
                        
                    </div>
                    </div>
                </div>
                </div>

               
                <!-- End Copyright Area -->
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>
 
    <!-- END QUICKVIEW PRODUCT -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="/js1/vendor/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="/js1/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="/js1/plugins.js"></script>
    <script src="/js1/slick.min.js"></script>
    <script src="/js1/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="/js1/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="/js1/main.js"></script>

</body>

</html>