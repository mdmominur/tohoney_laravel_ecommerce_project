@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Add a category</h4>
    @if(session('msg'))
        <p style="color: green">{{session('msg')}}</p>
    @endif

    @if($errors->any())
    @endif

    <form action="{{url('/categoryPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control @error('Category_name') is-validate @enderror" name="Category_name"><br>
        @error('Category_name')
        <p style="color:red;">
            {{$message}}
        </p>
        @enderror
        <br>
        <label for="img">Image:</label>
        <input type="file" value="" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" placeholder="Enter Product name" name="img">
        Preview:
        <img width="200" src="" id="blah" alt="Insert Thambnail">
        <br>
        @error('img')
        <p style="color:red;">
        {{$message}}
        </p>
        @enderror
        <br>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">

    </form>

@endsection

