@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Add Sub categroy</h4>
    <p style="color:green">
        @if(session('subCat'))
            {{session('subCat')}}
        @endif
    </p>
    <form action="{{url('/subCategoryPost')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="subCategory">Sub Category:</label>
            <input type="text" class="form-control @error('catId') is-validate @enderror" id="subCategory" placeholder="Enter Product name" name="subCategory">
            @error('subCategory')
            {{$message}}
            @enderror
        </div>

        <div class="form-group">
            <label for="subCategory">Sub Category:</label>
            <select class="form-control @error('catId') is-validate @enderror" name="catId" id="catName">
                <option value="">Select one</option>
                @foreach($cat as $category)
                    <option value="{{$category->id}}">{{$category->Category_name}}</option>
                @endforeach
            </select>
            @error('catId')
            {{$message}}
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
