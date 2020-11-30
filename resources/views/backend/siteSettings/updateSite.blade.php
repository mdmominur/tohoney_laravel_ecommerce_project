@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">Update Site</h4>
    <p style="color: green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>

    <form action="{{route('siteUpdatePost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$siteAll->id ?? ''}}">
        <div class="form-group">
            @error('site_name')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="site_name">Site_name:</label>
            <input type="text" value="{{$siteAll->site_name ?? ''}}" class="form-control @error('site_name') is-invalid @enderror" placeholder="Enter Product name" name="site_name">
        </div>
        <div class="form-group">
            @error('address')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="address">Address:</label>
            <input type="text" value="{{$siteAll->address ?? ''}}" class="form-control @error('address') is-invalid @enderror placeholder="Enter Product name" name="address">
        </div>
        <div class="form-group">
            @error('phone1')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="phone1">Phone 1:</label>
            <input type="text" value="{{$siteAll->phone1 ?? ''}}" class="form-control @error('phone1') is-invalid @enderror" placeholder="Enter Product name" name="phone1">
        </div>
        <div class="form-group">
            @error('phone2')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="phone2">Phone 2:</label>
            <input type="text" value="{{$siteAll->phone2 ?? ''}}" class="form-control @error('phone2') is-invalid @enderror" placeholder="Enter Product name" name="phone2">
        </div>
        <div class="form-group">
            @error('email1')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="email1">Email 1:</label>
            <input type="text" value="{{$siteAll->email1 ?? ''}}" class="form-control @error('email1') is-invalid @enderror" placeholder="Enter Product name" name="email1">
        </div>
        <div class="form-group">
            @error('email2')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="email2">Email 2:</label>
            <input type="text" value="{{$siteAll->email2 ?? ''}}" class="form-control @error('email2') is-invalid @enderror" placeholder="Enter Product name" name="email2">
        </div>
        <div class="form-group">
            @error('footer_Description')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="footer_Description">Footer Description:</label>
            <input type="text" value="{{$siteAll->footer_Description ?? ''}}" class="form-control @error('footer_Description') is-invalid @enderror"  placeholder="Enter Product name" name="footer_Description">
        </div>
        <div class="form-group">
            @error('facebook_link')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="facebook_link">Facebook link:</label>
            <input type="text" value="{{$siteAll->facebook_link ?? ''}}" class="form-control @error('facebook_link') is-invalid @enderror"  placeholder="Enter Product name" name="facebook_link">
        </div>
        <div class="form-group">
            @error('twitter_link')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="twitter_link">Twitter link:</label>
            <input type="text" value="{{$siteAll->twitter_link ?? ''}}" class="form-control @error('twitter_link') is-invalid @enderror"  placeholder="Enter Product name" name="twitter_link">
        </div>
        <div class="form-group">
            @error('linkedin_link')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="linkedin_link">Linkedin link:</label>
            <input type="text" value="{{$siteAll->linkedin_link ?? ''}}" class="form-control @error('linkedin_link') is-invalid @enderror"  placeholder="Enter Product name" name="linkedin_link">
        </div>
        <div class="form-group">
            @error('google_plus_link')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="google_plus_link">Google plus link:</label>
            <input type="text" value="{{$siteAll->google_plus_link ?? ''}}" class="form-control @error('google_plus_link') is-invalid @enderror"  placeholder="Enter Product name" name="google_plus_link">
        </div>
        <div class="form-group">
            @error('copyright')
                <p style="color: #ff0000">{{$message}}</p>
            @enderror
            <label for="copyright">Copyright:</label>
            <input type="text" value="{{$siteAll->copyright ?? ''}}" class="form-control @error('copyright') is-invalid @enderror"  placeholder="Enter Product name" name="copyright">
        </div>
        <div class="form-group">
            @error('logo')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="logo">Logo:</label>
            <input type="file" value="" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" placeholder="Enter Product name" name="logo">
            Preview:
            <img width="200" src="{{asset('img'.'/'.$siteAll->logo)}}" id="blah" alt="Insert Thambnail">
        </div>

        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>
@endsection
