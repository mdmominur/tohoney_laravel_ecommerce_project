@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Update Sub categroy</h4>
    <p style="color:green">
        @if(session('subCat'))
            {{session('subCat')}}
        @endif
    </p>
    <form action="{{url('/subCategoryUpdatePost')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$subCat->id}}">
        <div class="form-group">
            <label for="subCategory">Sub Category:</label>
            <input type="text" value="{{$subCat->subCategory}}" class="form-control @error('catId') is-validate @enderror" id="subCategory" placeholder="Enter Product name" name="subCategory">
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
            <p>
                @error('catId'){{$message}}@enderror
            </p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

