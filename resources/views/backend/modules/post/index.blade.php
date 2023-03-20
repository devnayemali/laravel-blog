@extends('backend.layouts.master')

@section('page_title', 'Post List')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <h6 class="m-0 font-weight-bold text-primary">Post List</h6>
                            </div>
                            <div class="col-xl-6 text-right">
                                <a class="btn btn-info px-3" href="{{ route('post.create') }}">Add Post</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$posts->isEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Tag</th>
                                            <th>Status</th>
                                            <th>Photo</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Tag</th>
                                            <th>Status</th>
                                            <th>Photo</th>
                                            <th>Active</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></td>
                                                <td>{{ $post->category?->name }} </td>
                                                <td>
                                                    @php
                                                        $btn_classes = [
                                                            'btn-primary',
                                                            'btn-secondary',
                                                            'btn-success',
                                                            'btn-danger',
                                                            'btn-warning',
                                                            'btn-info',
                                                            'btn-dark'
                                                        ];
                                                    @endphp
                                                    @foreach ($post->tag as $tag)
                                                        <button class="btn btn-info mb-1 btn-sm {{ $btn_classes[random_int(0,6)] }}">{{ $tag->name }}</button>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {!! $post->is_approved == 1
                                                        ? '<span class="text-success">Approved</span>'
                                                        : '<span class="text-danger">Not Approved</span>' !!}
                                                </td>
                                                <td style="width:180px; height:140px;">
                                                    <img data-toggle="modal" data-target="#show_post_img"
                                                        data-src="{{ url('image/post/original/' . $post->photo) }}"
                                                        class="post_img" style="width:100%; height:100%; cursor: pointer;"
                                                        src="{{ url('image/post/thumbnail/' . $post->photo) }}"
                                                        alt="post img">
                                                </td>
                                                </td>
                                                <td>
                                                    <a class="mr-1 text-info" href="{{ route('post.show', $post->id) }}"><i
                                                            class="fas fa-eye"></i></a> |
                                                    <a class="mx-1 text-warning"
                                                        href="{{ route('post.edit', $post->id) }}"><i
                                                            class="fas fa-edit"></i></a> |

                                                    {!! Form::open([
                                                        'method' => 'delete',
                                                        'id' => 'form_' . $post->id,
                                                        'route' => ['post.destroy', $post->id],
                                                        'class' => 'd-inline-block',
                                                    ]) !!}
                                                    {!! Form::button('<i class="text-danger fas fa-trash"></i>', [
                                                        'type' => 'button',
                                                        'data-id' => $post->id,
                                                        'class' => 'delete_btn ml-1 border-0 bg-transparent',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-danger text-center">
                                <h4 class="mb-0 d-inline-block mr-4">there are no data in the table.</h4>
                                <a href="{{ route('post.create') }}">Add Data</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Large modal -->
    <div class="modal fade" id="show_post_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="w-img" id="show_img_model" src="{{ url('image/post/original/' . $post->photo) }}" alt="post img">
                </div>
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

    @push('js')
        <script>
            $('.delete_btn').on('click', function() {
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to delete ?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit();
                    }
                })
            });


            // show post image full
            $('.post_img').on('click', function() {
                $post_img = $(this).attr('data-src');
                $('#show_img_model').attr('src', $post_img);
            });
        </script>
    @endpush


@endsection
