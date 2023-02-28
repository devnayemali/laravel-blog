@extends('backend.auth.layouts.master')

@section('page_title', 'Login')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    {!! Form::open(['class' => 'user']) !!}

                                    <div class="form-group">
                                        {!! Form::label('email', 'E-mail Address') !!}
                                        {!! Form::email('email', null, ['class' => $errors->has('email') ? 'is-invalid form-control form-control-user mb-1' : 'form-control form-control-user mb-1']) !!}
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password', 'Password') !!}
                                        {!! Form::password('password', ['class' => $errors->has('password') ? 'is-invalid form-control form-control-user mb-1' : 'form-control form-control-user mb-1'], null) !!}
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-primary btn-user btn-block']) !!}

                                    {!! Form::close() !!}

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
