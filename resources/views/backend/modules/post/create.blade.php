@extends('backend.layouts.master')

@section('page_title', 'Create Post')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Post</h6>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['route' => 'post.store', 'method' => 'post', 'class' => 'user', 'files' => true]) !!}

                        @include('backend.modules.post.form')

                        {!! Form::button('Create Post', ['type' => 'submit', 'class' => 'btn btn-primary btn-user']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
