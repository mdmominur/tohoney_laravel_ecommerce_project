@extends('backend.master')
@section('content')
    <style>
        .form-group p{color: red}
    </style>
    <h4 class="header-title mb-4">Add Testimonial</h4>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('testimonialPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Person Name" name="name">
            <p>
                @error('name')
                {{$message}}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" placeholder="Enter Person role" name="role">
            <p>
                @error('role')
                {{$message}}
                @enderror
            </p>
        </div>


        <div class="form-group">
            <label for="quote">Quote:</label>
            <textarea placeholder="Enter Quote" class="form-control @error('quote') is-invalid @enderror" name="quote" id="quote"></textarea>
            <p>
                @error('quote')
                {{$message}}
                @enderror
            </p>

        </div>


        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"  name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <br>
            <img width="200" id="blah" alt="Insert Thambnail">
            <p>
                @error('image')
                {{$message}}
                @enderror
            </p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
