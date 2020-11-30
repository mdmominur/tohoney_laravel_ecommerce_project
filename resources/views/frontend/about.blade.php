@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>About us</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>About</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- about-area start -->
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-wrap text-center">
                        <h3>{{$about->Title}}</h3>
                        <p>{!! nl2br($about->description) !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area end -->
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
@endsection
