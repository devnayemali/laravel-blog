@extends('backend.layouts.master')

@section('page_title', 'Tag List')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <h6 class="m-0 font-weight-bold text-primary">Tag List</h6>
                            </div>
                            <div class="col-xl-6 text-right">
                                <a class="btn btn-info px-3" href="{{ route('tag.create') }}">Tag Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$tags->isEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Order By</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Order By</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Active</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $tag->name }}</td>
                                                <td>{{ $tag->slug }}</td>
                                                <td>{{ $tag->order_by }}</td>
                                                <td>{!! $tag->status == 1
                                                    ? '<span class="text-success">Active</span>'
                                                    : '<span class="text-danger">Inactive</span>' !!}</td>
                                                <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                                                <td>{{ $tag->updated_at == $tag->created_at ? 'Not Updated Yet' : $tag->updated_at->toDayDateTimeString() }}
                                                </td>
                                                <td>
                                                    <a class="mr-1 text-info"
                                                        href="{{ route('tag.show', $tag->id) }}"><i
                                                            class="fas fa-eye"></i></a> |
                                                    <a class="mx-1 text-warning"
                                                        href="{{ route('tag.edit', $tag->id) }}"><i
                                                            class="fas fa-edit"></i></a> |

                                                    {!! Form::open([
                                                        'method' => 'delete',
                                                        'id' => 'form_' . $tag->id,
                                                        'route' => ['tag.destroy', $tag->id],
                                                        'class' => 'd-inline-block',
                                                    ]) !!}
                                                    {!! Form::button('<i class="text-danger fas fa-trash"></i>', [
                                                        'type' => 'button',
                                                        'data-id' => $tag->id,
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
                                <a href="{{ route('tag.create') }}">Add Data</a>
                            </div>
                        @endif
                    </div>
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
        </script>
    @endpush


@endsection
