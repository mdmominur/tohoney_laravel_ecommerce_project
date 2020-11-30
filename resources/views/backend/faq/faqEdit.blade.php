@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Edit faq</h4>
    <p style="color:green">
        @if(session('subCat'))
            {{session('subCat')}}
        @endif
    </p>
    <form action="{{route('faqEditPost')}}" method="post">
        @csrf
        <input type="hidden" value="{{$faq->id}}" name="id">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" value="{{$faq->title}}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Product name" name="title">
            @error('title')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter Description">{{$faq->description}}</textarea>
            @error('description')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>

@endsection

