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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::model($profile, ['route' => 'profile.store', 'method' => 'post', 'class' => 'user']) !!}

                        <div class="form-group">

                            {!! Form::label('phone', 'Phone') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Your Phone']) !!}

                            {!! Form::label('address', 'Address') !!}
                            {!! Form::text('address', null, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Your Address']) !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::label('division_id', 'Select Division') !!}
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
                                <div class="col-lg-6">
                                    <label for="thana_id">Select Thana</label>
                                    <select name="thana_id" id="thana_id" class="form-control mb-3" disabled="disabled">
                                        <option>Select Thana</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="union_id">Select Union</label>
                                    <select name="union_id" id="union_id" class="form-control mb-3" disabled="disabled">
                                        <option>Select Union</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label class="mr-4" for="union_id">Select Gender</label>
                                    <span class="mr-4">{!! Form::radio('gender', 'male', false) !!} Male</span>
                                    <span class="mr-4">{!! Form::radio('gender', 'female', false) !!} Female</span>
                                    <span>{!! Form::radio('gender', 'other', false) !!} Other</span>
                                </div>
                            </div>
                        </div>

                        {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary btn-user']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card shadow mb-4 pb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Photo</h6>
                    </div>
                    <div class="card-body">
                        <img class="img-thumbnail mb-2" id="previous_image"
                            src="{{ url('image/user/' . $profile?->photo) }}"
                            style="{{ $profile?->photo != null ? 'display:blcok' : 'display:none' }}">
                        <label class="d-block">Upload Photo</label>
                        <form>
                            <input type="file" class="d-block" id="image_input" value="Upload">
                            <button type="reset" id="reset" class="d-none">reset</button>
                        </form>
                        <p class="text-danger mb-0" id="error_message"></p>
                        <button style="width:100px" class="btn btn-outline-success my-3 d-block"
                            id="image_upload_button">Upload</button>
                        <img class="img-thumbnail" id="image_preview">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        if ($profile === null) {
            $profile_exit = 0;
        } else {
            $profile_exit = 1;
        }
    @endphp

@endsection
@push('js')
    <script src="{{ url('backend/js/axios.min.js') }}"></script>
    <script>
        // Show Image
        let photo;
        $('#image_input').on('change', function(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                photo = reader.result;
                $('#image_preview').attr('src', photo);
            }
            reader.readAsDataURL(file);
        });

        let is_loading = false;
        const handleLoadng = () => {
            if (is_loading) {
                $('#image_upload_button').html(`<div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                                </div>`);
            } else {
                $('#image_upload_button').html('Upload');
            }
        }

        // Upload Image
        $('#image_upload_button').on('click', function() {
            if (photo != undefined) {
                is_loading = true;
                handleLoadng();
                $("#error_message").text('');
                axios.post(domain + '/dashboard/upload-photo', {
                    'photo': photo
                }).then(res => {
                    is_loading = false;
                    handleLoadng();
                    let response = res.data;
                    $('#reset').trigger('click');
                    $("#previous_image").attr('src', response.photo).show();
                    $('#image_preview').attr('src', '');

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
                        icon: response.cls,
                        title: response.msg
                    })

                });
            } else {
                is_loading = false;
                handleLoadng();
                $("#error_message").text('Please Select A Photo');
            }
        });


        let domain = window.location.origin;
        const getDistricts = (division_id, selected = null) => {
            axios.get(domain + '/get-districts/' + division_id).then(res => {
                let element = $('#district_id');
                element.removeAttr('disabled');
                element.empty();
                element.append(`<option> Select District </option>`);
                $('#thana_id').attr('disabled', 'disabled').empty().append('`<option> Select Thana </option>`');
                $('#union_id').attr('disabled', 'disabled').empty().append('`<option> Select Union </option>`');
                let districts = res.data;
                districts.forEach((district, index) => {
                    element.append(
                        `<option ${ selected == district.id ? 'selected' : '' } value ="${ district.id }"> ${ district.name } </option>`
                    );
                });
            })
        };

        const getThanas = (district_id, selected = null) => {

            axios.get(domain + '/get-thanas/' + district_id).then(res => {
                let element = $('#thana_id');
                element.empty();
                element.removeAttr('disabled');
                let thanas = res.data;
                element.append(`<option> Select Thana </option>`);
                $('#union_id').attr('disabled', 'disabled').empty().append('`<option> Select Union </option>`');
                thanas.forEach((thana, index) => {
                    element.append(
                        `<option ${ selected == thana.id ? 'selected' : '' } value ="${ thana.id }"> ${ thana.name } </option>`
                    );
                });
            })
        };

        const getUnions = (thana_id, selected = null) => {

            axios.get(domain + '/get-unions/' + thana_id).then(res => {
                let element = $('#union_id');
                element.empty();
                element.removeAttr('disabled');
                element.append(`<option> Select Union </option>`);
                let unions = res.data;
                unions.forEach((union, index) => {
                    element.append(
                        `<option ${ selected == union.id ? 'selected' : '' } value ="${ union.id }"> ${ union.name } </option>`
                    );
                });
            })
        };

        $('#division_id').on('change', function() {
            getDistricts($(this).val());
        });

        $('#district_id').on('change', function() {
            getThanas($(this).val());
        });

        $('#thana_id').on('change', function() {
            getUnions($(this).val());
        });

        if ('{{ $profile_exit }}' == 1) {
            getDistricts('{{ $profile?->division_id }}', '{{ $profile?->district_id }}');
            getThanas('{{ $profile?->district_id }}', '{{ $profile?->thana_id }}');
            getUnions('{{ $profile?->thana_id }}', '{{ $profile?->union_id }}');
        }
    </script>
@endpush
