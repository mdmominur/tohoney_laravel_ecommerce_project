@extends('backend.master')
@section('content')
    <style>
        .form-group p{color: red}
    </style>
    <h4 class="header-title mb-4">Testimonial Update</h4>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('testimonialUpdatePost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$testimonial->id}}" name="id">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text"  value="{{$testimonial->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Person Name" name="name">
            <p>
                @error('name')
                {{$message}}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" value="{{$testimonial->role}}" class="form-control @error('role') is-invalid @enderror" id="role" placeholder="Enter Person role" name="role">
            <p>
                @error('role')
                {{$message}}
                @enderror
            </p>
        </div>


        <div class="form-group">
            <label for="quote">Quote:</label>
            <textarea placeholder="Enter Quote" class="form-control @error('quote') is-invalid @enderror" name="quote" id="quote">{{$testimonial->quote}}</textarea>
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
            <img width="200" src="{{asset('img/testimonial'.'/'.$testimonial->image)}}" id="blah" alt="Insert Thambnail">
            <p>
                @error('image')
                {{$message}}
                @enderror
            </p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
