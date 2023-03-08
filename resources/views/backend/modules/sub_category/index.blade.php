@extends('backend.layouts.master')

@section('page_title', 'Sub Category List')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <h6 class="m-0 font-weight-bold text-primary">Sub Create List</h6>
                            </div>
                            <div class="col-xl-6 text-right">
                                <a class="btn btn-info px-3" href="{{ route('sub-category.create') }}">Add Sub Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$sub_categories->isEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Slug</th>
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
                                            <th>Category</th>
                                            <th>Slug</th>
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
                                        @foreach ($sub_categories as $sub_category)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $sub_category->name }}</td>
                                                <td>{{ $sub_category->category?->name }}</td>
                                                <td>{{ $sub_category->slug }}</td>
                                                <td>{{ $sub_category->order_by }}</td>
                                                <td>{!! $sub_category->status == 1
                                                    ? '<span class="text-success">Active</span>'
                                                    : '<span class="text-danger">Inactive</span>' !!}</td>
                                                <td>{{ $sub_category->created_at->toDayDateTimeString() }}</td>
                                                <td>{{ $sub_category->updated_at == $sub_category->created_at ? 'Not Updated Yet' : $sub_category->updated_at->toDayDateTimeString() }}
                                                </td>
                                                <td>
                                                    <a class="mr-1 text-info"
                                                        href="{{ route('sub-category.show', $sub_category->id) }}"><i
                                                            class="fas fa-eye"></i></a> |
                                                    <a class="mx-1 text-warning"
                                                        href="{{ route('sub-category.edit', $sub_category->id) }}"><i
                                                            class="fas fa-edit"></i></a> |

                                                    {!! Form::open([
                                                        'method' => 'delete',
                                                        'id' => 'form_' . $sub_category->id,
                                                        'route' => ['sub-category.destroy', $sub_category->id],
                                                        'class' => 'd-inline-block',
                                                    ]) !!}
                                                    {!! Form::button('<i class="text-danger fas fa-trash"></i>', [
                                                        'type' => 'button',
                                                        'data-id' => $sub_category->id,
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
                                <a href="{{ route('sub-category.create') }}">Add Data</a>
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
