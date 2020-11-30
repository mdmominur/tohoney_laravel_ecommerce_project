@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View Comments</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>SL.</th>
            <th>Title</th>
            <th>User Name</th>
            <th>Comments</th>
            <th>Publish date</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($comments as $key => $comment)
            <tr @if($comment->status == 1) style="background: #E3EAEF" @endif>
                <td>{{$comments->firstItem()+$key}}</td>
                <td>{{substr($comment->get_post->title, 0, 30).'...' }}</td>
                <td>{{$comment->name}}</td>
                <td>{{substr($comment->comment,0 , 50).'...'}}</td>
                <td>{{$comment->created_at->format('d M Y')}}</td>
                <td><a class="btn btn-success" href="{{route('commentToBlog', $comment->id)}}">View</a></td>
                <td><a class="btn btn-danger" href="{{route('deleteComments', $comment->id)}}">Delete</a></td>
            </tr>
        @empty
            <td colspan="50">No comments yet</td>
        @endforelse
        </tbody>
    </table>
    {{$comments->links()}}

@endsection
