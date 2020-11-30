@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Frequently Asked Questions (FAQ)</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>FAQ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- about-area start -->
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-wrap text-center">
                        <h3>FAQ</h3>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @php
                            $num = 0;
                        @endphp
                        @forelse($faqs as $faq)
                        <div class="card border-0">
                            <div class="card-header border-0 p-0 my-3">
                                <button class="btn btn-link text-left py-3 w-100 text-white @if($num != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#faq{{$faq->id}}" aria-expanded="@if($num == 0)true @else false @endif" aria-controls="faq{{$faq->id}}">
                                    {{$faq->title}}
                                </button>
                            </div>

                            <div id="faq{{$faq->id}}" class="collapse @if($num == 0) show @endif" aria-labelledby="faq{{$faq->id}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{$faq->description}}
                                </div>
                            </div>
                        </div>
                            @php
                                $num = $num+1;
                            @endphp
                        @empty
                            No Faq found
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area end -->

@endsection
