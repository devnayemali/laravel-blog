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

    <section class="contact-us">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="sidebar-item contact-form">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="sidebar-heading">
                            <h2>Send us a message</h2>
                        </div>
                        <div class="content">
                            {!! Form::open(['id' => 'contact', 'method' => 'post', 'route' => 'contact.store']) !!}
                            {!! Form::text('name', null, ['id' => 'name', 'placeholder' => 'Your Name', 'required' => true]) !!}
                            {!! Form::text('phone', null, ['id' => 'name', 'placeholder' => 'Your Phone', 'required' => true]) !!}
                            {!! Form::email('email', null, ['id' => 'email', 'placeholder' => 'Your Email', 'required' => true]) !!}
                            {!! Form::text('subject', null, ['id' => 'subject', 'placeholder' => 'Your Subject', 'required' => true]) !!}
                            {!! Form::textarea('message', null, [
                                'id' => 'message',
                                'placeholder' => 'Message',
                                'rows' => 6,
                                'required' => true,
                            ]) !!}
                            {!! Form::button('Send Message', ['type' => 'submit', 'id' => 'form-submit']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div id="map">
                        <iframe
                            src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

    @push('js')
        <script>
            $('.comment-reply-btn').on('click', function() {
                $(this).parent('.comment-form-wrap').addClass('active');
            });
        </script>
    @endpush
@endsection
