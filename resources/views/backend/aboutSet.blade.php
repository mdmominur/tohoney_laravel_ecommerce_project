@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Update About</h4>
    <p style="color: green">
        @if(session('msg'))
            {{session('msg')}}
            @endif
    </p>

    <form action="{{url('/aboutPost')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$about->id ?? ''}}">
        <div class="form-group">
            <label for="Title">Title:</label>
            <input type="text" value="{{$about->Title ?? ''}}" class="form-control" id="Title" placeholder="Enter Product name" name="Title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description"class="form-control" id="description" placeholder="Enter Description">{{$about->description ?? ''}}</textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>
@endsection
