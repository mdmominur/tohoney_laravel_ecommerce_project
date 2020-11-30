@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Update Product</h4>
    <p style="color:green">
        @if(session('product'))
            {{session('product')}}
        @endif
    </p>
    <form action="{{ route('productUpdatePost' )}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="ProductName">Product name:</label>
            <input type="text" value="{{$pro->ProductName}}" class="form-control" id="ProductName" placeholder="Enter Product name" name="ProductName">
        </div>
        <div class="form-group">
            <label for="CatId">Category name:</label>
            <select class="form-control" name="CatId" id="CatId">
                <option value="">Select one</option>
                @foreach($cat as $data)
                    <option @if($data->id == $pro->CatId) selected @endif value="{{$data->id}}">{{$data->Category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="SubCatId">Sub Category name:</label>
            <select class="form-control" name="SubCatId" id="SubCatId">
                <option value="">Select one</option>
                @foreach($SubCat as $data)
                    <option @if($data->id == $pro->SubCatId) selected @endif value="{{$data->id}}">{{$data->subCategory}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ProductSummary">Product Summary:</label>
            <textarea class="form-control" placeholder="Enter Product Summary" name="ProductSummary" id="ProductSummary" >{{$pro->ProductSummary}}</textarea>
        </div>
        <div class="form-group">
            <label for="ProductDescription">Product Description</label>
            <textarea placeholder="Enter Product Description"  value="" class="form-control" name="ProductDescription" id="ProductDescription" >{{$pro->ProductDescription}}</textarea>
        </div>
        <div class="form-group">
            <label for="ProductPrice">Product Price:</label>
            <input type="text" value="{{$pro->ProductPrice}}" class="form-control"  id="ProductPrice" placeholder="Enter Product Price" name="ProductPrice">
        </div>
        <div class="form-group">
            <label for="ProductQuantity">ProductQuantity:</label>
            <input type="text" class="form-control" value="{{$pro->ProductQuantity}}" id="ProductQuantity" placeholder="Enter Product Quantity" name="ProductQuantity">
        </div>
        <div class="form-group">
            <label for="ProductThambnail">Product Thambnail:</label>
            <input type="file" class="form-control" id="ProductThambnail"  name="ProductThambnail" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <br>
            <img src="{{asset('img/products/thumbnail').'/'.$pro->ProductThambnail}}" width="200" id="blah" alt="Insert Thambnail">
        </div>
        <div class="form-group">
            <label for="ProductGallery">Product Gallery:</label>
            <table class="table table-bordered col-md-6">
                <tr>
                    <th>Images</th>
                    <th>Action</th>
                </tr>

                @foreach($proGallery as $item)
                    <tr>
                        <td><img width="200" src="{{asset('img/products/gallery'.'/'.$item->img_name)}}" alt="{{$item->img_name}}"></td>
                        <td><a class="btn btn-danger" href="{{route('deleteGalleryImg', $item->id)}}">Delete</a></td>
                    </tr>
                @endforeach

            </table>

        </div>
        <div class="form-group">
            <label for="img_name">Add More Gallery Phote:</label>
            <input type="file" multiple class="form-control" id="img_name"  name="img_name[]">
            <br>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
