@extends('backend.master')
@section('content')

    <h4 class="header-title mb-4">Add Post</h4>
    <p style="color: green">
        @if(session('msg'))
            {{session('msg')}}
        @endif

    </p>
    <form action="{{route('blogPost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Title...">
            <p class="error">
                @error('title')
                {{$message}}
                @enderror
            </p>

        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                @forelse($cat as $item)
                <option value="{{$item->id}}">{{$item->Category_name}}</option>
                @empty
                    <option value="">No categroy found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Enter description..."></textarea>
            <p class="error">
                @error('description')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="form-group">
            <label for="blog_image">Image:</label>
            <input type="file" class="form-control  @error('blog_image') is-invalid @enderror" id="blog_image"  name="blog_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <p class="error">
                @error('blog_image')
                {{$message}}
                @enderror
            </p>
            <br>
            <img width="200" id="blah" alt="Insert Thambnail">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
