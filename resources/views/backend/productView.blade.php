@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View Prodacts</h4>
    <p style="color:red">
        @if(session('delete'))
            {{session('delete')}}
        @endif
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Product name</th>
            <th scope="col">Category</th>
            <th scope="col">Sub Category</th>
            <th scope="col">Summary</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Thambnail</th>
            <th colspan="3" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($product as $key => $pro)
            <tr>
                <td>{{$product->firstItem()+$key}}</td>
                <td>{{$pro->ProductName}}</td>
                <td>{{$pro->getCategories->Category_name}}</td>
                <td>{{$pro->getSubCat->subCategory}}</td>
                <td>{{Str::limit($pro->ProductSummary, '30', '...')}}</td>
                <td>{{Str::limit($pro->ProductDescription, '30', '...')}}</td>
                <td>${{$pro->ProductPrice}}</td>
                <td>{{$pro->ProductQuantity}}</td>
                <td><img width="150" src="{{url('img/products/thumbnail').'/'.$pro->ProductThambnail}}" alt="{{$pro->ProductName}}"></td>
                <td><a class="btn btn-success" target="__blank" href="{{url('SingleProduct')}}/{{$pro->Slug}}">View</a></td>
                <td><a class="btn btn-primary" href="{{url('productEdit')}}/{{$pro->id}}">Edit</a></td>
                <td><a class="btn btn-danger" href="{{url('productDelete')}}/{{$pro->id}}">Delete</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="10">No Data available</td>
            </tr>

        @endforelse
        </tbody>
    </table>
    {{$product->links()}}

@endsection
