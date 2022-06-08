<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image1/x-icon" href="/images1/logo/lugalogo.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- purano font nachalera fontaweosmoe ko chalako cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="/css1/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="/css1/owl.carousel.min.css">
    <link rel="stylesheet" href="/css1/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="/css1/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="/css1/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="/css1/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="/css1/custom.css">

    <link rel="stylesheet" href="/css1/themify-icons.css">
    


    <!-- Modernizr JS -->
    


    <script src="/js1/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
        <!-- Start Header Style -->
        @include('partials.shopheader')
        <!-- End Header Style -->
    <div class="body__overlay"></div>
         

        @yield('sidemenu')
        <!-- End Blog Area -->
        <!-- Start Footer Area -->
        @include('partials.shopfooter')