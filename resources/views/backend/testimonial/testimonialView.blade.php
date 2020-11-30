@extends('backend.master')
@section('content')

    <h4 class="header-title mb-4">View Testimonials</h4>
    <p style="color:red">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Quote</th>
            <th scope="col">Image</th>
            <th colspan="50" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($testimonial as $key => $item)
            <tr>
                <td>{{$testimonial->firstItem()+$key}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->role}}</td>
                <td>{{$item->quote}}</td>
                <td><img width="150" src="{{url('img/testimonial').'/'.$item->image}}" alt="{{$item->name}}"></td>
                <td><a class="btn btn-primary" href="{{route('testimonialUpdate', $item->id)}}">Edit</a></td>
                <td><a class="btn btn-danger" href="{{route('testimonialDelete', $item->id)}}">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Data available</td>
            </tr>

        @endforelse
        </tbody>
    </table>
    {{$testimonial->links()}}
@endsection
