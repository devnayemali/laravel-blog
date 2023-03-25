@extends('frontend.layouts.master')

@section('page_title', $sub_title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $title }}</h4>
                            <h2>{{ $sub_title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')
    @foreach ($all_posts as $all_post)
        <div class="col-lg-12">
            <div class="blog-post">
                <div class="blog-thumb">
                    <img src="{{ url('image/post/thumbnail/' . $all_post->photo) }}" alt="{{ $all_post->title }}">
                </div>
                <div class="down-content">
                    <span>{{ $all_post->category?->name }}</span>
                    <a href="{{ route('front.single', $all_post->slug) }}">
                        <h4>{{ $all_post->title }}</h4>
                    </a>
                    <ul class="post-info">
                        <li><a href="#">{{ $all_post->user?->name }}</a></li>
                        <li><a href="#">{{ $all_post->created_at->format('M d, Y') }}</a></li>
                        <li><a href="#">12 Comments</a></li>
                    </ul>
                    <p> {{ strip_tags(Str::substr($all_post->description, 0, 500)) . '...' }} </p>
                    {{-- <p> {!! $post->description !!} </p> --}}
                    <a class="btn btn-info mb-4" href="{{ route('front.single', $all_post->slug) }}">Read More</a>
                    <div class="post-options">
                        <div class="row">
                            <div class="col-6">
                                <ul class="post-tags">
                                    <li><i class="fa fa-tags"></i></li>
                                    @foreach ($all_post->tag as $tag)
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

    @if (count($all_posts) < 1)
        <h3 class="text-danger">No Post Found For {{ $sub_title }}</h3>
    @endif

    <div class="col-xl-12">
        {{ $all_posts->links() }}
    </div>
@endsection
