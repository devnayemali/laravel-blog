@extends('backend.layouts.master')

@section('page_title', 'Tag Details')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tag Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 300px;">Id</th>
                                        <td>{{ $tag->id }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Name</th>
                                        <td>{{ $tag->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Slug</th>
                                        <td>{{ $tag->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Order By</th>
                                        <td>{{ $tag->order_by }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Status</th>
                                        <td>{{ ($tag->status == 1) ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Create At</th>
                                        <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 300px;">Updated At</th>
                                        <td>{{ ($tag->created_at == $tag->updated_at) ? 'Not Updated Yet' : $tag->updated_at->toDayDateTimeString() }}</td>
                                    </tr>
                                </thead>
                            </table>
                            <a class="btn btn-primary px-3" href="{{ route('tag.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
