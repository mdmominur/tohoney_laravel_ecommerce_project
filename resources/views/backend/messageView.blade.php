@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">{{$msg_details->name}}</h4>
    <h6>Email: {{$msg_details->email}}</h6>
    <h6>Subject: {{$msg_details->subject}}</h6>
    <p>
        {{$msg_details->msg}}
    </p>

    <a href="{{route('message')}}" class="btn btn-primary">Back to message page</a>
    <a href="{{route('messageUnseen', $msg_details->id)}}" class="btn btn-success">Mark as unread</a>



@endsection
