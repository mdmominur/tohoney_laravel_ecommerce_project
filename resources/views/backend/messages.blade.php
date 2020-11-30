@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View Messages</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>SL.</th>
            <th>User Name</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Email</th>
            <th>Time</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($messages as $key => $message)
            <tr @if($message->status == 1) style="background: #E3EAEF;" @endif>
                <td>{{$messages->firstItem()+$key}}</td>
                <td>{{$message->name}}</td>
                <td>{{$message->subject}}</td>
                <td>{{substr($message->msg,0 , 50).'...'}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->created_at->format('d M Y')}} at {{$message->created_at->format('H:I:sA')}}</td>
                @if($message->status == 1)
                <td><a class="btn btn-primary" href="{{route('messageView', $message->id)}}">Read</a></td>
                @else
                <td><a class="btn btn-primary" href="{{route('messageUnseen', $message->id)}}">Mark as unread</a></td>
                @endif
                <td><a class="btn btn-danger" href="">Delete</a></td>
            </tr>
        @empty
            <td colspan="50">You have no Message yet</td>
        @endforelse
        </tbody>
    </table>
    {{$messages->links()}}

@endsection

