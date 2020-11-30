@extends('backend.master')
@section('content')
    <style>
        .form-group p{color: red}
    </style>
    <h4 class="header-title mb-4">Add Banner</h4>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('testimonialPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Banner title" name="title">
            <p>
                @error('title')
                    {{$message}}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea placeholder="Enter banner description" class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>
            <p>
                @error('description')
                {{$message}}
                @enderror
            </p>

        </div>


        <div class="form-group">
            <label for="bannerImg">Product Thambnail:</label>
            <input type="file" class="form-control @error('bannerImg') is-invalid @enderror" id="bannerImg"  name="bannerImg" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <br>
            <img width="200" id="blah" alt="Insert Thambnail">
            <p>
                @error('bannerImg')
                    {{$message}}
                @enderror
            </p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
