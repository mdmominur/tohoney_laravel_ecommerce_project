<!doctype html>
<html lang="en">

<!-- Mirrored from coderthemes.com/highdmin/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:51:24 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Highdmin - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

</head>


<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">

        <div class="slimscroll-menu" id="remove-scroll">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{url('/home')}}" class="logo">
                            <span>
                                <img src="{{asset('assets/images/logo.png')}}" alt="" height="22">
                            </span>
                    <i>
                        <img src="{{asset('assets/images/logo_sm.png')}}" alt="" height="28">
                    </i>
                </a>
            </div>

            <!-- User box -->
            <div class="user-box">
                <div class="user-img">
                    <img src="{{asset('img/user'.'/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                </div>
                <h5><a href="#">{{auth::user()->name}}</a> </h5>
                <p class="text-muted">Admin Head</p>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">

                    <!--<li class="menu-title">Navigation</li>-->
                    <li>
                        <a href="{{url('home')}}">
                            <i class="fi-air-play"></i> <span> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">
                            <i class="fi-globe" target="_blank"></i><span> Visit site </span>
                        </a>
                    </li>
                    <li>
                        @php
                            $messages = \App\contact::orderBy('created_at', 'desc')->limit(5)->get();
                            $count = \App\contact::where('status', 1)->get()->count();
                        @endphp
                        <a href="{{route('message')}}">
                            <i class="fa fa-envelope" target="_blank"></i><span> Messages </span>
                            @if($count>0)
                                <span class="badge badge-danger badge-pill float-right">{{$count}}</span>
                            @else
                                <span class="menu-arrow"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        @php
                            $unread = \App\comments::where('status', 1)->count();
                        @endphp
                        <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Blogs </span>
                            @if($unread>0)
                                <span class="badge badge-danger badge-pill float-right">{{$unread}}</span>
                            @else
                                <span class="menu-arrow"></span>
                            @endif
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{ route('blogAdd') }}">Add Post</a></li>
                            <li><a href="{{ route('blogView') }}">View Post</a></li>
                            <li><a href="{{ route('blogComments') }}">View Comments
                                    @if($unread>0)
                                        <span class="badge badge-danger badge-pill float-right">{{$unread}}</span>
                                    @endif
                                </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Banner </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{ route('bannerAdd') }}">Add Banner</a></li>
                            <li><a href="{{ route('bannerView') }}">View Banner</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Categrory </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{ url('/category') }}">Add Category</a></li>
                            <li><a href="{{ url('/categoryView') }}">View Category</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Sub Category</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('subCategoryAdd')}}">Add Sub Categroy</a></li>
                            <li><a href="{{url('subCategoryView')}}">View Sub Category</a></li>
                            <li><a href="{{url('subCategoryTrush')}}">Trash Sub Categroy</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Products </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{url('product')}}">Add Products</a></li>
                            <li><a href="{{url('productView')}}">View Product</a></li>
                            <li><a href="{{route('ProductTrashed')}}">trashed Product</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Testimonial </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{route('testimonialAdd')}}">Add Testimonial</a></li>
                            <li><a href="{{route('testimonialView')}}">view Testimonial</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Faq </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{route('addFaq')}}">Add faq</a></li>
                            <li><a href="{{route('viewFaq')}}">view faq</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('setCountdown')}}">
                            <i class="fi-command"></i> <span> Countdown </span>
                        </a>
                    </li> <li>
                        <a href="{{route('newsLetter')}}">
                            <i class="fi-command"></i> <span> News Letter </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('aboutSet')}}">
                            <i class="fi-command"></i> <span> About </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('siteUpdate')}}">
                            <i class="fa fa-cog"></i> <span> Site Settings </span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>

<!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <!-- Top Bar Start -->
        <div class="topbar">

            <nav class="navbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="hide-phone app-search">
                        <form>
                            <input type="text" placeholder="Search..." class="form-control">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="fi-bell noti-icon"></i>
                            @if($unread>0)
                            <span class="badge badge-danger badge-pill noti-icon-badge">{{$unread}}</span>
                                @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">


                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0"><span class="float-right"></span>Notification</h5>
                            </div>

                            <div class="slimscroll" style="max-height: 230px;">
                                @php
                                    $comments = \App\comments::orderBy('created_at', 'desc')->limit(5)->get();
                                @endphp
                                @forelse($comments as $item)
                                <!-- item-->
                                <a href="{{route('commentToBlog', $item->id)}}" class="dropdown-item notify-item" @if($item->status == 1) style="background: #E3EAEF" @endif>
                                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                    <p class="notify-details">{{$item->name}} commented on a post you shared<small class="text-muted">{{$item->created_at->format('d m y')}} at {{$item->created_at->format('h:i:s a')}}</small></p>
                                </a>
                                    @empty
                                    <a class="dropdown-item notify-item">No notificatins</a>
                                @endforelse
                            </div>

                            <!-- All-->
                            <a href="{{route('blogComments')}}" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="fi-speech-bubble noti-icon"></i>

                            @if($count>0)<span class="badge badge-custom badge-pill noti-icon-badge"> {{$count}} </span>@endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0"><span class="float-right"><a href="#" class="text-dark"></a> </span>Chat</h5>
                            </div>

                            <div class="slimscroll" style="max-height: 230px;">
                                @forelse($messages as $message)
                                <!-- item-->
                                <a href="{{route('messageView',$message->id)}}" class="dropdown-item notify-item" @if($message->status == 1) style="background: #E3EAEF" @endif>
                                    <div class="notify-icon"><img src="" class="img-fluid rounded-circle" alt="" /> </div>
                                    <p class="notify-details">{{$message->name}}</p>
                                    <p class="text-muted font-13 mb-0 user-msg">{{substr($message->msg,0 , 50).'...'}}</p>
                                </a>
                                    @empty
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">No message yet</a>
                                    @endforelse

                            </div>

                            <!-- All-->
                            <a href="{{route('message')}}" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('img/user'.'/'.auth::user()->avatar)}}" alt="user" class="rounded-circle"> <span class="ml-1">{{auth::user()->name}}<i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fi-head"></i> <span onclick="myfunc()">My Account</span>
                            </a>


                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                                <i class="fi-power"></i><span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left disable-btn">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                    <li>
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard </h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to Highdmin admin panel !</li>
                            </ol>
                        </div>
                    </li>

                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->



        <footer class="footer">
            2018 © Highdmin. - Coderthemes.com
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->



<!-- jQuery  -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/js/waves.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

<!-- Flot chart -->
<script src="{{asset('../plugins/flot-chart/jquery.flot.min.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.time.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.resize.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.pie.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/curvedLines.js')}}"></script>
<script src="{{asset('../plugins/flot-chart/jquery.flot.axislabels.js')}}"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="../plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="../plugins/jquery-knob/jquery.knob.js"></script>

<!-- Dashboard Init -->
<script src="{{asset('assets/pages/jquery.dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/js/jquery.app.js')}}"></script>
<script>
    function myfunc() {
        window.location.href = '{{route('adminAccount')}}'
    }
</script>
@yield('footer_js')

</body>

<!-- Mirrored from coderthemes.com/highdmin/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:51:50 GMT -->
</html>
