<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item">

                    {!! Form::open(['method' => 'get', 'route' => 'front.search']) !!}
                    <div class="input-group">
                        {!! Form::search('search', null, ['class' => 'form-control', 'placeholder' => 'Type To Search...']) !!}
                        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', [
                            'class' => 'btn btn-success',
                            'type' => 'submit',
                        ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($recent_posts as $recent_post)
                                <li><a href="{{ route('front.single', $recent_post->slug) }}">
                                        <h5>{{ $recent_post->title }}</h5>
                                        <span>{{ $recent_post->created_at->format('M d, Y') }}</span>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>Categories</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('front.category', $category->slug) }}">- {{ $category->name }}</a>
                                    <ul>
                                        @foreach ($category->sub_categories as $sub_category)
                                            <li><a
                                                    href="{{ route('front.sub_category', [$category->slug, $sub_category->slug]) }}">--
                                                    {{ $sub_category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                        <h2>Tag Clouds</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($tags as $tag)
                                <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
