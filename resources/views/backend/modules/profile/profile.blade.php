@extends('backend.layouts.master')

@section('page_title', 'Profile Update')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                    </div>
                    <div class="card-body">

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        {!! Form::open(['route' => 'profile.store', 'method' => 'post', 'class' => 'user']) !!}

                        <div class="form-group">

                            {!! Form::label('phone', 'Phone') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Your Phone']) !!}

                            {!! Form::label('address', 'Address') !!}
                            {!! Form::text('address', null, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Your Address']) !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::label('division_id', 'Division') !!}
                                    {!! Form::select('division_id', $divisions, null, [
                                        'class' => 'form-control mb-3',
                                        'id' => 'division_id',
                                        'placeholder' => 'Select Division',
                                    ]) !!}
                                </div>
                                <div class="col-lg-6">
                                    <label for="district_id">Select District</label>
                                    <select name="district_id" id="district_id" class="form-control mb-3"
                                        disabled="disabled">
                                        <option>Select District</option>
                                    </select>
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6"></div>
                            </div>

                        </div>

                        {!! Form::button('Create Sub Category', ['type' => 'submit', 'class' => 'btn btn-primary btn-user']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ url('backend/js/axios.min.js') }}"></script>
        <script>
            let domain = window.location.origin;
            const getDistricts = (division_id) => {
                axios.get(domain + '/get-districts/' + division_id).then(res => {
                    let element = $('#district_id');
                    element.empty();
                    element.removeAttr('disabled');
                    let districts = res.data;
                    districts.forEach((district, index) => {
                        element.append(
                            `<option value ="${ district.id }"> ${ district.name } </option>`
                        );
                    });
                })
            };

            $('#division_id').on('change', function() {
                getDistricts($(this).val());
            });
        </script>
    @endpush
@endsection
