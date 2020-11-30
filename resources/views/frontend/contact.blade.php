@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Contact Us</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- contact-area start -->
    <div class="google-map">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147703055!2d-74.11976314309273!3d40.69740344223377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1547528325671" allowfullscreen></iframe>
        </div>
    </div>
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="contact-form form-style">
                        <div class="cf-msg"></div>
                        @if(session('msg'))
                            <p style="color: green; font-size: 15px; font-weight: bold;">
                                {{session('msg')}}
                            </p>
                        @endif
                        <form action="{{route('contactPost')}}" method="post" id="form">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    @error('name')
                                    <p style="color: red; font-size: 15px; font-weight: bold;">
                                        {{$message}}
                                    </p>
                                    @enderror
                                    <input type="text" class="@error('name') is-invalid @enderror" placeholder="Name" value="@auth {{\Illuminate\Support\Facades\Auth::user()->name}} @endauth" id="name" name="name">
                                </div>
                                <div class="col-12  col-sm-6">
                                    @error('Email')
                                    <p style="color: red; font-size: 15px; font-weight: bold;">
                                        {{$message}}
                                    </p>
                                    @enderror
                                    <input type="text" class="@error('Email') is-invalid @enderror" placeholder="Email" value="@auth {{\Illuminate\Support\Facades\Auth::user()->email}} @endauth" id="email" name="email">
                                </div>
                                <div class="col-12">
                                    @error('subject')
                                    <p style="color: red; font-size: 15px; font-weight: bold;">
                                        {{$message}}
                                    </p>
                                    @enderror
                                    <input type="text" class="@error('subject') is-invalid @enderror" placeholder="Subject" id="subject" name="subject">
                                </div>
                                <div class="col-12">
                                    @error('msg')
                                    <p style="color: red; font-size: 15px; font-weight: bold;">
                                        {{$message}}
                                    </p>
                                    @enderror
                                    <textarea class="contact-textarea @error('msg') is-invalid @enderror" placeholder="Message" id="msg" name="msg"></textarea>
                                </div>
                                <div class="col-12">
                                    <button id="submit" name="submit">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap">
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Address:
                                <p>{{$siteAll->address}}</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> Email address:
                                <p>
                                    <span>{{$siteAll->email1}}</span>
                                    <span>{{$siteAll->email2}}</span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> phone number:
                                <p>
                                    <span>{{$siteAll->phone1}}</span>
                                    <span>+{{$siteAll->phone2}}</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area end -->
@endsection
