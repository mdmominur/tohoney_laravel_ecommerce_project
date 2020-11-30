
@extends('frontend.master')
@section('content')

    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($banner as $item)
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner" style='background: url("{{asset('img/banner/'.$item->bannerImg)}}")'>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">{{$item->title}}</h2>
                                            <p data-swiper-parallax="-400">{{$item->description}}</p>
                                            <a href="{{url('shop')}}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->



    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">
                        @foreach($catAll as $catItem)
                        <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{asset('img/category'.'/'.$catItem->img)}}" alt="{{$catItem->Category_name}}">
                                <div class="featured-content">
                                    <a href="{{route('categoryProduct', $catItem->Category_name)}}">{{$catItem->Category_name}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->


    <!-- best sell-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="{{url('frontend')}}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">

                @forelse($bestSell as $item)
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{asset('img/products/thumbnail')}}/{{$item->getProducts->ProductThambnail}}" alt="{{$item->getProducts->ProductName}}">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{$item->getProducts->id}}" href="javascript:void(0);""><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('singleWish', $item->getProducts->Slug)}}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{route('singleCart', $item->getProducts->Slug)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{url('SingleProduct').'/'.$item->getProducts->Slug}}">{{$item->getProducts->ProductName}}</a></h3>
                            <h6>Sales Time: {{$item->sale_time}}</h6>
                            <p class="pull-left">${{$item->getProducts->ProductPrice}}

                            </p>
                            <ul class="pull-right d-flex">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>
                    </div>
                </li>

                    <!-- Modal area start -->
                    <div class="modal fade" id="exampleModalCenter{{$item->getProducts->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body d-flex">
                                    <div class="product-single-img w-50">
                                        <img src="{{asset('img/products/thumbnail').'/'.$item->getProducts->ProductThambnail}}" alt="{{$item->getProducts->ProductName}}">
                                    </div>
                                    <div class="product-single-content w-50">
                                        <h3>{{$item->getProducts->ProductName}}</h3>
                                        <div class="rating-wrap fix">
                                            <span class="pull-left">${{$item->getProducts->ProductPrice}}</span>
                                            <ul class="rating pull-right">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li>(05 Customar Review)</li>
                                            </ul>
                                        </div>
                                        <p>{{$item->getProducts->ProductSummary}}</p>
                                        <form action="{{route('singleCartAdd')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$item->getProducts->id}}" name="Product_id">
                                        <ul class="input-style">
                                            <li class="quantity cart-plus-minus">
                                                <input type="text" value="1" name="quantity" />
                                            </li>
                                            <li><a><input type="submit" value="Add to Cart"></a></li>
                                        </ul>
                                        </form>
                                        <ul class="cetagory">
                                            <li>Categories:</li>
                                            <li><a href="#">{{$item->getProducts->getCategories->Category_name}}</a></li>
                                        </ul>
                                        <ul class="socil-icon">
                                            <li>Share :</li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal area end -->

                @empty
                    <li class="col-12">No Data Available</li>
                @endforelse
            </ul>
        </div>
    </div>
    <!-- best sell-area end -->

    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="{{url('frontend')}}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach($product as $key => $data)
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12 @if($key>3) moreload @endif">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="{{asset('img/products/thumbnail').'/'.$data->ProductThambnail}}" alt="{{$data->ProductName}}">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{$data->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('singleWish', $data->Slug)}}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{route('singleCart', $data->Slug)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{url('SingleProduct').'/'.$data->Slug}}">{{$data->ProductName}}</a></h3>
                            <p class="pull-left">${{$data->ProductPrice}}

                            </p>
                            <ul class="pull-right d-flex">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>
                    </div>
                </li>

                    <!-- Modal area start -->
                    <div class="modal fade" id="exampleModalCenter{{$data->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body d-flex">
                                    <div class="product-single-img w-50">
                                        <img src="{{asset('img/products/thumbnail').'/'.$data->ProductThambnail}}" alt="{{$data->ProductName}}">
                                    </div>
                                    <div class="product-single-content w-50">
                                        <h3>{{$data->ProductName}}</h3>
                                        <div class="rating-wrap fix">
                                            <span class="pull-left">${{$data->ProductPrice}}</span>
                                            <ul class="rating pull-right">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li>(05 Customar Review)</li>
                                            </ul>
                                        </div>
                                        <p>{{$data->ProductSummary}}</p>
                                        <form action="{{route('singleCartAdd')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$data->id}}" name="Product_id">
                                            <ul class="input-style">
                                                <li class="quantity cart-plus-minus">
                                                    <input type="text" value="1" name="quantity" />
                                                </li>
                                                <li><a><input type="submit" value="Add to Cart"></a></li>
                                            </ul>
                                        </form>
                                        <ul class="cetagory">
                                            <li>Categories:</li>
                                            <li><a href="#">{{$data->getCategories->Category_name}}</a></li>
                                        </ul>
                                        <ul class="socil-icon">
                                            <li>Share :</li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal area End -->

                @endforeach
                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->

    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        @forelse($testimonial as $item)
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{$item->quote}}</p>
                                <h2>{{$item->name}}</h2>
                                <p>{{$item->role}}</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{asset('img/testimonial'.'/'.$item->image)}}" alt="{{$item->name}}">
                            </div>
                        </div>
                        @empty
                            <div class="test-items test-items2">
                                No testimonial found
                            </div>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
@endsection

@section('js_section')
    <script>
        if ($("#clock").length) {
            $('#clock').countdown('{{$countDown->year.'/'.$countDown->month.'/'.$countDown->day}}', function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<div class="box"><div>%m</div> <span>month</span> </div>' +
                    '<div class="box"><div>%D</div> <span>Days</span> </div>' +
                    '<div class="box"><div>%H</div> <span>Hours</span> </div>' +
                    '<div class="box"><div>%M</div> <span>Mins</span> </div>' +
                    '<div class="box"><div>%S</div> <span>Secs</span> </div>'));
            });
        }


    </script>

@endsection
