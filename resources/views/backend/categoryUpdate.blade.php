@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Update category</h4>
    @if(session('msg'))
        <p style="color: green">{{session('msg')}}</p>
    @endif

    @if($errors->any())
    @endif

    <form action="{{route('categoryUpdatePost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$cat->id}}">
        <input type="text" class="form-control @error('Category_name') is-validate @enderror" value="{{$cat->Category_name}}" name="Category_name"><br>
        @error('Category_name')
        <p style="color:red;">
            {{$message}}
        </p>
        @enderror
        <br>
        <label for="img">Image:</label>
        <input type="file" value="" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" placeholder="Enter Product name" name="img">
        Preview:
        <img width="200" src="{{asset('img/category'.'/'.$cat->img)}}" id="blah" alt="Insert Thambnail">
        <br>
        @error('img')
        <p style="color:red;">
            {{$message}}
        </p>
        @enderror
        <br>
        <input class="btn btn-primary" type="submit" value="Update" name="submit">

    </form>

@endsection

