@php
   $siteAll = \App\siteSettings::first();
@endphp
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{--<title>{{$title ?? ""}}</title>--}}
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{url('frontend')}}/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/metisMenu.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{url('frontend')}}/css/responsive.css">
    <!-- modernizr css -->
    <script src="{{url('frontend')}}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!--Start Preloader-->
<div class="preloader-wrap">
    <div class="spinner"></div>
</div>
<!-- search-form here -->
<div class="search-area flex-style">
    <span class="closebar">Close</span>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="search-form">
                    <form action="{{route('search')}}" method="post">
                        @csrf
                        <input type="text" name="search" placeholder="Search Here...">
                        <button><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- search-form here -->
<!-- header-area start -->
<header class="header-area">
    <div class="header-top bg-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <ul class="d-flex header-contact">
                        <li><i class="fa fa-phone"></i>{{$siteAll->phone1}}</li>
                        <li><i class="fa fa-envelope"></i>{{$siteAll->email1}}</li>
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="d-flex account_login-area">
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown_style">

                                @auth
                                    <li><a href="{{route('cart')}}">Cart</a></li>
                                    <li><a href="{{route('wishList')}}">wishlist</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{url('login')}}">Login</a></li>
                                    <li><a href="{{url('register')}}">Register</a></li>
                                @endauth

                            </ul>
                        </li>
                        @auth
                            <li><a href="{{route('catomer')}}"> Profile </a></li>
                         @else
                            <li><a href="/register"> Login/Register </a></li>
                         @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="fluid-container">
            <div class="row">
                <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('img'.'/'.$siteAll->logo)}}" alt="{{$siteAll->logo}}">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <nav class="mainmenu">
                        <ul class="d-flex">
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php') active @endif"><a href="{{url('/')}}">Home</a></li>
                           <li class="@if($_SERVER['PHP_SELF'] == '/index.php/about') active @endif" ><a href="{{route('about')}}">About</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/shop') active @endif" ><a href="{{route('shop')}}">Shop</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/wishList') active @endif" ><a href="{{route('wishList')}}">Wish List</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/cart') active @endif" ><a href="{{route('cart')}}">Cart</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/blog') active @endif" ><a href="{{route('blog')}}">Blog</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/faq') active @endif" ><a href="{{route('faq')}}">Faq</a></li>
                            <li class="@if($_SERVER['PHP_SELF'] == '/index.php/contact') active @endif" ><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                    <ul class="search-cart-wrapper d-flex">
                        <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                        @auth
                        <li>
                            @php
                                $wish = \App\wish::where('user_id', Auth::user()->id)->get();;
                                $total = 0;
                                $count = $wish->count();
                            @endphp
                            <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{$count}}</span></a>
                            <ul class="cart-wrap dropdown_style">

                                @forelse($wish as $item)
                                    <li class="cart-items">
                                    <div class="cart-img">
                                        <img style="height: 88px; width: 70px" src="{{asset('img/products/thumbnail'.'/'.$item->get_products->ProductThambnail)}}" alt="{{$item->get_products->ProductName}}">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{url('SingleProduct')}}/{{$item->get_products->Slug}}">{{$item->get_products->ProductName}}</a>
                                        <span>QTY : {{$item->quantity}}</span>
                                        <p>${{$item->quantity*$item->get_products->ProductPrice}}</p>
                                        <a href="{{route('wishDelete', $item->id)}}"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                                    @php
                                        $total += $item->quantity*$item->get_products->ProductPrice;
                                    @endphp
                                @empty
                                    <li>No wish Availabe</li>
                                @endforelse
                                <li>Subtotol: <span class="pull-right">${{$total}}</span></li>
                                <li>
                                    <a href="{{route('wishList')}}"><button>Wish list</button></a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        <li>
                            @php
                                $ipAddress = $_SERVER['REMOTE_ADDR'];
                                $carts = \App\Cart::where('Ip_address',$ipAddress)->get();
                                $count = $carts->count();
                                $subtotal = 0;
                            @endphp
                            <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{$count}}</span></a>
                            <ul class="cart-wrap dropdown_style">

                                @forelse($carts as $cart)
                                <li class="cart-items">
                                    <div class="cart-img">
                                        <img style="height: 88px; width: 70px" src="{{asset('img/products/thumbnail'.'/'.$cart->getProduct->ProductThambnail)}}" alt="">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{route('SingleProduct', $cart->getProduct->Slug)}}">{{$cart->getProduct->ProductName}}</a>
                                        <span>QTY : {{$cart->quantity}}</span>
                                        <p>${{$cart->getProduct->ProductPrice * $cart->quantity}}</p>
                                        <a href="{{route('singleCartDelete', $cart->id)}}"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                                    @php
                                        $subtotal += $cart->getProduct->ProductPrice * $cart->quantity;
                                    @endphp
                                    @empty
                                    <li>No cart available</li>
                                @endforelse

                                <li>Subtotol: <span class="pull-right">${{$subtotal}}</span></li>
                                <li>
                                    <a style="text-transform: none" href="{{url('cart')}}"><button>Cart</button></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                    <div class="responsive-menu-tigger">
                        <a href="javascript:void(0);">
                            <span class="first"></span>
                            <span class="second"></span>
                            <span class="third"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive-menu area start -->
        <div class="responsive-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-block d-lg-none">
                        <ul class="metismenu">
                            <li><a href="{{url('home')}}">Home</a></li>
                            <li><a href="{{route('about')}}">About</a></li>
                            <li class="sidemenu-items"><a href="{{route('shop')}}">Shop</a></li>
                            <li class="sidemenu-items"><a href="{{route('cart')}}">Cart</a></li>
                            <li class="sidemenu-items"><a href="{{route('blog')}}">Blog</a></li>
                            <li class="sidemenu-items"><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive-menu area start -->
    </div>
</header>
<!-- header-area end -->

@yield('content')

<!-- start social-newsletter-section -->
<section class="social-newsletter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="newsletter text-center">
                    <h3>Subscribe  Newsletter</h3>
                    @if(session('msg'))
                        <p style="color: green">{{session('msg')}}</p>
                        @endif
                    @error('email')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                    <div class="newsletter-form">
                        <form action="{{route('newsLetter')}}" method="post">
                            @csrf
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Your Email Address...">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</section>
<!-- end social-newsletter-section -->
<!-- .footer-area start -->
<div class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="footer-top-item">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="footer-top-text text-center">
                            <ul>
                                <li><a href="{{url('/')}}">home</a></li>
                                <li><a href="{{route('about')}}">our story</a></li>
                                <li><a href="{{route('shop')}}">feed shop</a></li>
                                <li><a href="{{route('blog')}}">how to eat blog</a></li>
                                <li><a href="{{route('contact')}}">contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-12">
                    <div class="footer-icon">
                        <ul class="d-flex">
                            <li><a href="{{$siteAll->facebook_link}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{$siteAll->twitter_link}}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{$siteAll->linkedin_link}}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{$siteAll->google_plus_link}}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-12">
                    <div class="footer-content">
                        <p>{{$siteAll->footer_Description}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8 col-sm-12">
                    <div class="footer-adress">
                        <ul>
                            <li><a href="#"><span>Email:</span>{{$siteAll->email2}}</a></li>
                            <li><a href="#"><span>Tel:</span> {{$siteAll->phone2}}</a></li>
                            <li><a href="#"><span>Adress:</span> {{$siteAll->address}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="footer-reserved">
                        <ul>
                            <li>{{$siteAll->copyright}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .footer-area end -->

<!-- jquery latest version -->
<script src="{{url('frontend')}}/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap js -->
<script src="{{url('frontend')}}/js/bootstrap.min.js"></script>
<!-- owl.carousel.2.0.0-beta.2.4 css -->
<script src="{{url('frontend')}}/js/owl.carousel.min.js"></script>
<!-- scrollup.js -->
<script src="{{url('frontend')}}/js/scrollup.js"></script>
<!-- isotope.pkgd.min.js -->
<script src="{{url('frontend')}}/js/isotope.pkgd.min.js"></script>
<!-- imagesloaded.pkgd.min.js -->
<script src="{{url('frontend')}}/js/imagesloaded.pkgd.min.js"></script>
<!-- jquery.zoom.min.js -->
<script src="{{url('frontend')}}/js/jquery.zoom.min.js"></script>
<!-- countdown.js -->
<script src="{{url('frontend')}}/js/countdown.js"></script>
<!-- swiper.min.js -->
<script src="{{url('frontend')}}/js/swiper.min.js"></script>
<!-- metisMenu.min.js -->
<script src="{{url('frontend')}}/js/metisMenu.min.js"></script>
<!-- mailchimp.js -->
<script src="{{url('frontend')}}/js/mailchimp.js"></script>
<!-- jquery-ui.min.js -->
<script src="{{url('frontend')}}/js/jquery-ui.min.js"></script>
<!-- main js -->
<script src="{{url('frontend')}}/js/scripts.js"></script>
@yield('js_section')
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
