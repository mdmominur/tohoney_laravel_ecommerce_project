@extends('backend.master')
@section('content')
        <h4 class="header-title mb-4">Category View Page</h4>
        <p style="color:red">
            @if(session('msg'))
                {{session('msg')}}
            @endif
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Sl</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col" colspan="2">Action</th>

            </tr>
            </thead>
            <tbody>
            @forelse($cat as $key => $data)
                <tr>
                    <td>{{$cat->firstItem()+$key}}</td>
                    <td>{{$data->Category_name}}</td>
                    <td><img width="200" src="{{asset('img/category'.'/'.$data->img) ?? ''}}" alt="{{$data->img ?? ''}}"></td>
                    <td><a class="btn btn-primary" href="{{route('categoryUpdate', $data->id)}}">Edit</a></td>
                    <td><a class="btn btn-danger" href="{{url('categoryDelete')}}/{{$data->id}}">Delete</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">No Data Available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
{{$cat->links()}}

@endsection



