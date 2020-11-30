@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">News Letter</h4>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>
    <form action="{{route('newsLetterPost')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="description">Send Mail to all subscriber</label>
            <textarea placeholder="Enter you message" rows="15" class="form-control @error('message') is-invalid @enderror" name="message" id="message"></textarea>
            <p style="color: red">
                @error('message')
                {{$message}}
                @enderror
            </p>

        </div>
        <button class="btn btn-primary">Send</button>
    </form>
    <br>
    <br>
    <br>
    <h4 class="header-title mb-4">Subscribers</h4>
    <p style="color:red">
        @if(session('delete'))
            {{session('delete')}}
        @endif
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Sl</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2">Action</th>

        </tr>
        </thead>
        <tbody>
        @forelse($newsLetter as $key => $data)
            <tr>
                <td>{{$newsLetter->firstItem()+$key}}</td>
                <td>{{$data->email}}</td>
                <td><a class="btn btn-danger" href="">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Data Available</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$newsLetter->links()}}

@endsection



