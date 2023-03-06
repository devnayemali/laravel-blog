@extends('backend.layouts.master')

@section('page_title', 'Create Category')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
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

                        {!! Form::open(['route' => 'category.store', 'method' => 'post', 'class' => 'user']) !!}

                        @include('backend.modules.category.form')

                        {!! Form::button('Create Category', ['type' => 'submit', 'class' => 'btn btn-primary btn-user']) !!}

                        {!! Form::close() !!}
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
