@extends('frontend.layouts.master')

@section('page_title', 'Home')


@section('banner')
    @include('frontend.includes.banner')
@endsection


@section('content')
    @foreach ($posts as $post)
        <div class="col-lg-12">
            <div class="blog-post">
                <div class="blog-thumb">
                    <img src="{{ url('image/post/thumbnail/' . $post->photo) }}" alt="{{ $post->title }}">
                </div>
                <div class="down-content">
                    <span>{{ $post->category?->name }}</span>
                    <a href="{{ route('front.single', $post->slug) }}">
                        <h4>{{ $post->title }}</h4>
                    </a>
                    <ul class="post-info">
                        <li><a href="#">{{ $post->user?->name }}</a></li>
                        <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                        <li><a href="#">12 Comments</a></li>
                    </ul>
                    <p> {{ strip_tags(Str::substr($post->description, 0, 500)) . '...' }} </p>
                    {{-- <p> {!! $post->description !!} </p> --}}
                    <a class="btn btn-info mb-4" href="{{ route('front.single', $post->slug) }}">Read More</a>
                    <div class="post-options">
                        <div class="row">
                            <div class="col-6">
                                <ul class="post-tags">
                                    <li><i class="fa fa-tags"></i></li>
                                    @foreach ($post->tag as $tag)
                                        <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a>,</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="post-share">
                                    <li><i class="fa fa-share-alt"></i></li>
                                    <li><a href="#">Facebook</a>,</li>
                                    <li><a href="#"> Twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-lg-12">
        <div class="main-button">
            <a href="{{ route('front.all_post') }}">View All Posts</a>
        </div>
    </div>
@endsection
