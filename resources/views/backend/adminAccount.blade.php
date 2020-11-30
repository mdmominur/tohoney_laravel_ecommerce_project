@extends('backend.master')
@section('content')
    <style>
        .form-group p{color: red}
    </style>
    <h4 class="header-title mb-4">Account Settings</h4>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('adminAccountPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="avatar">Change Image:</label>
            <br>
            <img width="200" id="blah" alt="Insert Thambnail" src="{{asset('img/user'.'/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}">
            <input type="file" class="form-control" id="avatar"   name="avatar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="form-control" id="name" placeholder="Enter Banner title" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
