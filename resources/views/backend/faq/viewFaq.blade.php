@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View Faqs</h4>
    <p style="color:red">
        @if(session('delete'))
            {{session('delete')}}
        @endif
    </p>
    <p style="color:green">
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
            <th colspan="10" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($faqs as $key => $faq)
            <tr>
                <td>{{$faqs->firstItem() + $key}}</td>
                <td>{{$faq->title}}</td>
                <td>{{$faq->description}}</td>
                <td><a class="btn btn-primary" href="{{route('faqEdit', $faq->id)}}">Edit</a></td>
                <td><a class="btn btn-danger" href="{{route('faqDelete', $faq->id)}}">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Data Available</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$faqs->links()}}

@endsection
