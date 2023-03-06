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
                        {!! Form::open(['route' => 'category.store', 'method' => 'post', 'class' => 'user']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Category Name') !!}
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control form-control-user mb-1']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Category Slug') !!}
                            {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control form-control-user mb-1']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('order_by', 'Category Serial') !!}
                            {!! Form::number('order_by', null, ['class' => 'form-control form-control-user mb-1']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Category Status') !!}
                            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], 1) !!}
                        </div>

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
