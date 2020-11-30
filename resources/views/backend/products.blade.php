@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Add Product</h4>
    <p style="color:green">
        @if(session('product'))
            {{session('product')}}
        @endif
    </p>

    <form action="{{url('/productPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="ProductName">Product name:</label>
            <input type="text" class="form-control" id="ProductName" placeholder="Enter Product name" name="ProductName">
        </div>
        <div class="form-group">
            <label for="CatId">Category name:</label>
            <select class="form-control" name="CatId" id="CatId">
                <option value="">Select one</option>
                @foreach($cat as $data)
                    <option value="{{$data->id}}">{{$data->Category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="SubCatId">Sub Category name:</label>
            <select class="form-control" name="SubCatId" id="SubCatId">
                <option value="">Select one</option>
                @foreach($SubCat as $data)
                    <option value="{{$data->id}}">{{$data->subCategory}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ProductSummary">Product Summary:</label>
            <textarea class="form-control" placeholder="Enter Product Summary" name="ProductSummary" id="ProductSummary" ></textarea>
        </div>
        <div class="form-group">
            <label for="ProductDescription">Product Description</label>
            <textarea placeholder="Enter Product Description" class="form-control" name="ProductDescription" id="ProductDescription" ></textarea>
        </div>
        <div class="form-group">
            <label for="ProductPrice">Product Price:</label>
            <input type="text" class="form-control" id="ProductPrice" placeholder="Enter Product Price" name="ProductPrice">
        </div>
        <div class="form-group">
            <label for="ProductQuantity">ProductQuantity:</label>
            <input type="text" class="form-control" id="ProductQuantity" placeholder="Enter Product Quantity" name="ProductQuantity">
        </div>
        <div class="form-group">
            <label for="ProductThambnail">Product Thambnail:</label>
            <input type="file" class="form-control" id="ProductThambnail"  name="ProductThambnail" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <br>
            <img width="200" id="blah" alt="Insert Thambnail">
        </div>
        <div class="form-group">
            <label for="product_gallery">Image Gallery:</label>
            <input type="file" class="form-control" multiple id="product_gallery"  name="img_name[]" onchange="document.getElementById('').src = window.URL.createObjectURL(this.files[0])">
            <br>

        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
