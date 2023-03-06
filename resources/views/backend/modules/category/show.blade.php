@extends('backend.layouts.master')

@section('page_title', 'Category Details')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 300px;">Id</th>
                                        <td>{{ $category->id }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Name</th>
                                        <td>{{ $category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Slug</th>
                                        <td>{{ $category->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Order By</th>
                                        <td>{{ $category->order_by }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Status</th>
                                        <td>{{ ($category->status == 1) ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Create At</th>
                                        <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Updated At</th>
                                        <td>{{ ($category->created_at == $category->updated_at) ? 'Not Updated Yet' : $category->updated_at->toDayDateTimeString() }}</td>
                                    </tr>
                                </thead>
                            </table>
                            <a class="btn btn-primary px-3" href="{{ route('category.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
