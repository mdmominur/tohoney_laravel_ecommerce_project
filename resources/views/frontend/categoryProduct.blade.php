
@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach($product as $key => $pro)
                            <li class="col-xl-3 col-lg-4 col-sm-6 col-12 @if($key>7) moreload @endif">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <img src="{{asset('img/products/thumbnail').'/'.$pro->ProductThambnail}}" alt="{{$pro->ProductName}}">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{$pro->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="{{route('singleWish', $pro->Slug)}}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{route('singleCart', $pro->Slug)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('SingleProduct', $pro->Slug)}}">{{$pro->ProductName}}</a></h3>
                                        <p class="pull-left">${{$pro->ProductPrice}}

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
                            <div class="modal fade" id="exampleModalCenter{{$pro->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="modal-body d-flex">
                                            <div class="product-single-img w-50">
                                                <img src="{{asset('img/products/thumbnail').'/'.$pro->ProductThambnail}}" alt="{{$pro->ProductName}}">
                                            </div>
                                            <div class="product-single-content w-50">
                                                <h3>{{$pro->ProductName}}</h3>
                                                <div class="rating-wrap fix">
                                                    <span class="pull-left">${{$pro->ProductPrice}}</span>
                                                    <ul class="rating pull-right">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li>(05 Customar Review)</li>
                                                    </ul>
                                                </div>
                                                <p>{{$pro->ProductSummary}}</p>
                                                <form action="{{route('singleCartAdd')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$pro->id}}" name="Product_id">
                                                    <ul class="input-style">
                                                        <li class="quantity cart-plus-minus">
                                                            <input type="text" value="1" name="quantity" />
                                                        </li>
                                                        <li><a><input type="submit" value="Add to Cart"></a></li>
                                                    </ul>
                                                </form>
                                                <ul class="cetagory">
                                                    <li>Categories:</li>
                                                    <li><a href="#">{{$pro->getCategories->Category_name}}</a></li>
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
        </div>
    </div>
    <!-- product-area end -->
@endsection
