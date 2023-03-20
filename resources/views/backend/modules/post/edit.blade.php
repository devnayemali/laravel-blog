@extends('backend.layouts.master')

@section('page_title', 'Edit Post')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Post</h6>
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

                        {!! Form::model( $post, ['route' => ['post.update', $post->id], 'method' => 'put', 'class' => 'user']) !!}

                        @include('backend.modules.post.form')

                        {!! Form::button('Update Category', ['type' => 'submit', 'class' => 'btn btn-primary btn-user']) !!}

                        {!! Form::close() !!}
                        <a class="btn btn-primary mt-4 px-3" href="{{ route('post.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $('#name').on('input', function() {
                var name = $(this).val();
                var slug = name.replaceAll(' ', '-');
                $('#slug').val(slug.toLowerCase());
            });
        </script>
    @endpush


@endsection
