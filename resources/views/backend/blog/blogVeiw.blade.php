@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View Blogs</h4>
    <p style="color:red">
    @if(session('msg'))
        {{session('msg')}}
    @endif
    </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image</th>
                <th>Publish date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $key => $blog)
            <tr>
                <td>{{$blogs->firstItem()+$key}}</td>
                <td>{{substr($blog->title,0 , 30).'...'}}</td>
                <td>{{$blog->get_categories->Category_name}}</td>
                <td>{{substr($blog->description,0 , 50).'...'}}</td>
                <td><img width="200" src="{{asset('img/blog'.'/'.$blog->blog_image)}}" alt="{{$blog->blog_image}}"></td>
                <td>{{$blog->created_at->format('d M Y')}}</td>
                <td><a class="btn btn-success" href="{{route('singleBlog', $blog->blog_slug)}}">View</a></td>
                <td><a class="btn btn-primary" href="{{route('blogUpdate', $blog->id)}}">Edit</a></td>
                <td><a class="btn btn-danger" href="{{route('blogDelete', $blog->id)}}">Delete</a></td>
            </tr>
            @empty
                <td colspan="50">You have no post yet</td>
            @endforelse
        </tbody>
    </table>
    {{$blogs->links()}}

@endsection
