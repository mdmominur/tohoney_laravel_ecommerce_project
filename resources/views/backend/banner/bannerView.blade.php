@extends('backend.master')
@section('content')

    <h4 class="header-title mb-4">View Banner</h4>
    <p style="color:red">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th colspan="3" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($banner as $key => $item)
            <tr>
                <td>{{$banner->firstItem()+$key}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>

                <td><img width="150" src="{{url('img/banner').'/'.$item->bannerImg}}" alt="{{$item->title}}"></td>
                <td><a class="btn btn-danger" href="{{route('bannerDelete', $item->id)}}">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Data available</td>
            </tr>

        @endforelse
        </tbody>
    </table>
    {{$banner->links()}}

@endsection
