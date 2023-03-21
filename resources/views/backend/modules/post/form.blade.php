<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Post Slug') !!}
    {!! Form::text('slug', null, [
        'id' => 'slug',
        'maxlength' => '10',
        'class' => 'form-control form-control-user mb-1',
    ]) !!}
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Select Category') !!}
            {!! Form::select('category_id', $categories, null, [
                'id' => 'category_id',
                'class' => 'form-control',
                'placeholder' => 'Select Category',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Select Sub Category') !!}
            <select class="form-control" name="sub_category_id" id="sub_category_id"></select>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, [
        'id' => 'description',
        'class' => 'form-control form-control-user mb-1',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('tag_id', 'Tags:', ['class' => 'mr-3']) !!}
    @foreach ($tags as $tag)
        <span class="mr-4"> {!! Form::checkbox('tag_ids[]', $tag->id, ( Route::currentRouteName() == 'post.edit' ) ? in_array($tag->id, $selected_tags) : false ) !!} {{ $tag->name }}</span>
    @endforeach
</div>

<div class="form-group">
    {!! Form::label('photo', 'Photo') !!}
    {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo']) !!}

    @if (Route::currentRouteName() == 'post.edit')
        <img class="mt-2" src="{{ url('/image/post/original/', $post->photo) }}">
    @endif
</div>


<div class="form-group">
    {!! Form::label('status', 'Post Status') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, [
        'class' => 'form-control',
        'placeholder' => 'Select Post Status',
    ]) !!}
</div>

@push('js')
    <script src="{{ url('backend/js/axios.min.js') }}"></script>
    <script src="{{ url('backend/js/ckeditor.js') }}"></script>
    <script>
        // Auto Write Post Slug
        $('#title').on('input', function() {
            var title = $(this).val();
            var slug = title.replaceAll(' ', '-');
            $('#slug').val(slug.toLowerCase());
        });

        const get_sub_categories = (category_id) => {
            // get sub categoy by api
            let sub_categories;
            sub_categoy_element.empty();
            let rounte_name = '{{ Route::currentRouteName() }}';
            axios.get(domainName + '/dashboard/get-subcategory/' + category_id).then(res => {
                sub_categories = res.data;
                if (sub_categories.length > 0) {
                    // sub_categories.map((sub_categoy, index) => (
                    //     $('#sub_category_id').append(
                    //         `<option value ="${ sub_categoy.id }"> ${ sub_categoy.name } </option>`)
                    // ));

                    sub_categories.forEach((sub_category, index) => {
                        let selected = '';
                        if (rounte_name == 'post.edit') {
                            let sub_category_id = '{{ $post->sub_category_id ?? null}}';
                            if ( sub_category_id == sub_category.id) {
                                selected = 'selected';
                            }
                        }
                        sub_categoy_element.append(
                            `<option ${selected} value ="${ sub_category.id }"> ${ sub_category.name } </option>`
                        );
                    });

                } else {
                    $("#sub_category_id").append(`<option value ="0"> No Data </option>`);
                }
            });
        }


        let domainName = window.location.origin;
        let sub_categoy_element = $("#sub_category_id");
        sub_categoy_element.append(`<option value ="0"> Select Sub Category </option>`);
        $('#category_id').on('change', function() {
            let category_id = $('#category_id').val();
            // get categoy id
            get_sub_categories(category_id);
        });

        // ckeditor js
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    @if (Route::currentRouteName() == 'post.edit')
        <script>
            get_sub_categories({{ $post->category_id }});
        </script>
    @endif

@endpush
