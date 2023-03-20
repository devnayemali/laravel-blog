@extends('backend.layouts.master')

@section('page_title', 'Post Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Post Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">Author Name</th>
                                        <td><a href="#">{{ $post->user?->name }}</a></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Title</th>
                                        <td>{{ $post->title }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Slug</th>
                                        <td>{{ $post->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Status</th>
                                        <td>{!! $post->status == 1
                                            ? '<span class="text-success">Active</span>'
                                            : '<span class="text-danger">Inactive</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Is Approved</th>
                                        <td>{!! $post->is_approved == 1
                                            ? '<span class="text-success">Approved</span>'
                                            : '<span class="text-danger">Not Approved</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Description</th>
                                        <td>{!! $post->description !!}</td>
                                    </tr><tr>
                                        <th style="width: 200px;">Photo</th>
                                        <td><img class="m-img" src="{{ url('image/post/original/'. $post->photo) }}" alt="post img"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Create At</th>
                                        <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px;">Updated At</th>
                                        <td>{{ $post->created_at == $post->updated_at ? 'Not Updated Yet' : $post->updated_at->toDayDateTimeString() }}
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <a class="btn btn-primary px-3" href="{{ route('post.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Category & Tag Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 150px;">Category</th>
                                        <td><a
                                                href="{{ route('category.show', $post->category_id) }}">{{ $post->category?->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 150px;">Sub Category</th>
                                        <td><a href="{{ route('sub-category.show', $post->sub_category_id) }}">{{ $post->sub_category?->name }}</a></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 150px;">Tag</th>
                                        <td>
                                            @php
                                                $btn_classes = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark'];
                                            @endphp
                                            @foreach ($post->tag as $tag)
                                                <a href="{{ route('tag.show', $tag->id) }}">
                                                    <button class="btn btn-info btn-sm {{ $btn_classes[random_int(0, 6)] }}">{{ $tag->name }}</button>
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <a class="btn btn-primary px-3" href="{{ route('post.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
