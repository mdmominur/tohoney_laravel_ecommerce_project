@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Blog Details</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Blog Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- blog-details-area start-->
    <div class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details-wrap">
                        <img src="{{asset('img/blog'.'/'.$blog->blog_image)}}" alt="{{$blog->blog_image}}">
                        <h3>{{$blog->title}}</h3>
                        <ul class="meta">
                            <li>{{$blog->created_at->format('d M Y')}}</li>
                            <li>By {{$blog->user_name}}</li>
                        </ul>
                         <p>{!! nl2br($blog->description) !!}</p>
                        <div class="share-wrap">
                            <div class="row">
                                <div class="col-sm-7 ">
                                    <ul class="socil-icon d-flex">
                                        <li>share it on :</li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-5 text-right">
                                    @if($next_blog)
                                    <a href="{{route('singleBlog',$next_blog->blog_slug)}}">Next Post <i class="fa fa-long-arrow-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="comment-form-area">
                        <div class="comment-main">
                            <h3 class="blog-title"><span>({{$comments->count()}})</span>Comments:</h3>
                            <ol class="comments">
                                <li class="comment even thread-even depth-1">
                                    @foreach($comments as $comment)
                                        <div class="comment-wrap" id="{{$comment->id}}">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                @php
                                                    $user = \App\User::where('email', $comment->email)->first();
                                                @endphp
                                                <img width="103" height="103" style="border-radius: 50%;" src="{{asset('img/user'.'/'.$user->avatar)}}" alt="{{$user->avatar}}">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>{{$comment->name}} </h4>
                                                    <span>{{$comment->created_at->format('D M Y')}} at {{$comment->created_at->format('H:mA')}}</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>{{$comment->comment}}</p>
                                                </div>
                                                @auth
                                                @if($comment->email == \Illuminate\Support\Facades\Auth::user()->email || \Illuminate\Support\Facades\Auth::user()->role == 2)
                                                <a href="{{route('deleteComments', $comment->id)}}">Delete</a>
                                                @endif

                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </li>
                            </ol>
                        </div>
                        @auth
                        <div id="respond" class="sewl-comment-form comment-respond form-style">
                            <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                            <form id="commentform" class="comment-form" action="{{route('blogComments')}}" method="post">
                                @csrf
                                <input name="post_id" value="{{$blog->id}}" id="post_id" type="hidden">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sewl-form-inputs no-padding-left">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <input id="name" class="@error('name') is-invalid @enderror" name="name" value="" tabindex="2" placeholder="Name" type="text">
                                                    @error('name')
                                                    <p style="color: red">
                                                        {{$message}}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <input id="email"  class="@error('email') is-invalid @enderror"  name="email" value="@auth {{\Illuminate\Support\Facades\Auth::user()->email}} @endauth" tabindex="3" placeholder="Email" type="text">
                                                    @error('email')
                                                    <p style="color: red">
                                                        {{$message}}
                                                    </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sewl-form-textarea no-padding-right">
                                            <textarea id="comment" name="comment" class="@error('comment') is-invalid @enderror"  tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                            @error('comment')
                                            <p style="color: red">
                                                {{$message}}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-submit">
                                            <input name="submit" id="submit" value="Send" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
                <div class="col-lg-3 col-12">
                    <aside class="sidebar-area">
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories</h4>
                            <ul>
                                @forelse($cat as $item)
                                    <li><a href="{{route('categoryBlog',$item->id )}}">{{$item->Category_name}}</a></li>
                                @empty
                                    <li>No category found</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="widget widget_recent_entries recent_post">
                            <h4 class="widget-title">Recent Post</h4>
                            <ul>
                                @foreach($recent_post as $itme)
                                <li>
                                    <div class="post-img">
                                        <img width="70" height="60" src="{{asset('img/blog'.'/'.$itme->blog_image)}}" alt="{{$itme->blog_image}}">
                                    </div>
                                    <div class="post-content">
                                        <a href="{{route('singleBlog', $itme->blog_slug)}}">{{$itme->title}}</a>
                                        <p>{{$itme->created_at->format('d M Y')}}</p>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-details-area end -->

@endsection
