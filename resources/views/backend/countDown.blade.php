@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Set countdown</h4>
    <p style="color: green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('countDownPost')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$countDown->id}}">
        <div class="form-group">
            <label for="Title">Title:</label>
            <input type="text" value="{{$countDown->Title}}" class="form-control @error('Title') is-invalid @enderror" id="Title" placeholder="Enter Countdown name" name="Title">
            @error('Title')
            <p style="color: red">{{$message}}</p>
            @enderror
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter Description">{{$countDown->description}}</textarea>
            @error('description')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        </div>
        <div class="form-group">
            <label for="day">Day:</label>
            <input type="number" value="{{$countDown->day}}" style="width: 80px;" class="form-control @error('day') is-invalid @enderror" id="day" name="day">
            @error('day')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="month">Month:</label>
            <input type="number" value="{{$countDown->month}}" style="width: 80px;" class="form-control @error('month') is-invalid @enderror" id="month" name="month">
            @error('month')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" value="{{$countDown->year}}" style="width: 80px;" class="form-control @error('year') is-invalid @enderror" id="year"  name="year">
            @error('year')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>
@endsection
