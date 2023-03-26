@extends('frontend.layouts.master')

@section('page_title', $post->title)


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
    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ url('image/post/thumbnail/' . $post->photo) }}" alt="{{ $post->title }}">
            </div>
            <div class="down-content">
                <span>{{ $post->category?->name }}</span>
                <h4>{{ $post->title }}</h4>
                <ul class="post-info">
                    <li><a href="#">{{ $post->user?->name }}</a></li>
                    <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                    <li><a href="#">12 Comments</a></li>
                </ul>
                <p>
                    {!! $post->description !!}
                </p>
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
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                <h2>4 comments</h2>
            </div>
            <div class="content">
                <ul>
                    {{-- <li>
                        <div class="author-thumb">
                            <img src="{{ url('frontend/assets/images/comment-author-01.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                            <h4>Charles Kate<span>May 16, 2020</span></h4>
                            <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo.
                                Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus
                                convallis eleifend posuere id tellus.</p>
                        </div>
                    </li>
                    <li class="replied">
                        <div class="author-thumb">
                            <img src="{{ url('frontend/assets/images/comment-author-02.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                            <h4>Thirteen Man<span>May 20, 2020</span></h4>
                            <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
                        </div>
                    </li>
                    <li>
                        <div class="author-thumb">
                            <img src="{{ url('frontend/assets/images/comment-author-03.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                            <h4>Belisimo Mama<span>May 16, 2020</span></h4>
                            <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget ligula.
                                Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis ac, molestie nibh.
                            </p>
                        </div>
                    </li>
                    <li class="replied">
                        <div class="author-thumb">
                            <img src="{{ url('frontend/assets/images/comment-author-02.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                            <h4>Thirteen Man<span>May 22, 2020</span></h4>
                            <p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc,
                                gravida in erat sit amet, feugiat viverra leo.</p>
                        </div>
                    </li> --}}

                    @foreach ($post->comment as $comment)
                    <li>
                        <div class="author-thumb">
                            <img src="{{ url('frontend/assets/images/comment-author-03.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                            <h4>{{ $comment->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span></h4>
                            {{-- <h4>{{ $post->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span></h4> --}}
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            <div class="sidebar-heading">
                <h2>Your comment</h2>
            </div>
            <div class="content">
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                            <textarea name="comment" rows="6" placeholder="Type your comment"></textarea>
                            <button type="submit" class="main-button">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('msg'))
        @push('js')
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: '{{ session('cls') }}',
                    title: '{{ session('msg') }}'
                })
            </script>
        @endpush
    @endif



@endsection
