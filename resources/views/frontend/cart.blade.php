
@extends('frontend.master')

@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><span>Shopping Cart</span></li>
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
                    @if(session('msg'))
                        <p style="color: green">{{session('msg')}}</p>
                        @endif
                    <form action="{{route('cartUpdate')}}" method="post">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pro as $item)
                            <tr>
                                <input type="hidden" value="{{$item->id}}" name="cart_id[]">
                                <td class="images"> <img src="{{asset('img/products/thumbnail').'/'.$item->getProduct->	ProductThambnail}}" alt="{{$item->getProduct->ProductName}}"> </td>
                                <td class="product"><a href="{{url('SingleProduct')}}/{{$item->getProduct->Slug}}">{{$item->getProduct->ProductName}}</a></td>
                                <td class="ptice">${{$item->getProduct->ProductPrice}}</td>
                                <td class="quantity cart-plus-minus">
                                    <input type="text" name="quantity[]" value="{{$item->quantity}}" />
                                </td>
                                <td class="total">${{$item->getProduct->ProductPrice * $item->quantity}}</td>
                                <td class="remove"><i onclick="Sweetalert({{$item->id}})" class="fa fa-times"></i></td>
                            </tr>
                            @php

                            @endphp
                                @empty
                                <tr>
                                    <td colspan="10">No Cart available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{url('shop')}}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" id="coupon" value="{{$coupon ?? ''}}" placeholder="Cupon Code">
                                        <span id="couponBtn"> <center>Apply Coupon</center></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{$subTotal}}</li>
                                        <li><span class="pull-left">Discount (%)</span>%{{$discount}}</li>
                                        <li><span class="pull-left"> Total </span>${{$grand_total}}</li>
                                    </ul>
                                    <a href="{{url('checkout')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection
@section('js_section')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function Sweetalert(id){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.href = 'singleCartDelete/'+id
                }
            })

        }

        var couponBtn = document.getElementById('couponBtn');
        couponBtn.addEventListener("click", function () {
            var coupon = document.getElementById('coupon').value;
            window.location.href = '{{url('cart')}}/'+coupon;
        })



    </script>
    @endsection
