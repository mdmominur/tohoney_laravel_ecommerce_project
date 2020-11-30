
@extends('frontend.master')

@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wishlist</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Wishlist</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <table class="table-responsive cart-wrap">
                            <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="product">Quantity</th>
                                <th class="ptice">Price</th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($wish as $item)
                            <tr>
                                <td class="images"><img src="{{asset('img/products/thumbnail'.'/'.$item->get_products->ProductThambnail)}}" alt="{{$item->get_products->ProductName}}"></td>
                                <td class="product"><a href="{{url('SingleProduct')}}/{{$item->get_products->Slug}}">{{$item->get_products->ProductName}}</a></td>
                                <form action="{{route('singleCartAdd')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$item->product_id}}" name="Product_id">
                                <td class="quantity cart-plus-minus">
                                    <input type="text" name="quantity" value="{{$item->quantity}}" />
                                </td>
                                <td class="ptice">${{$item->quantity*$item->get_products->ProductPrice}}</td>
                                <td class="addcart"><button>Add to cart</button></td>
                                </form>
                                <td class="remove"><a href="{{route('wishDelete', $item->id)}}"><i class="fa fa-times"></i></a></td>
                            </tr>
                            @empty
                                <td colspan="50">No Wish Available</td>
                            @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection
@section('js_section')
    <script>

    </script>
@endsection
