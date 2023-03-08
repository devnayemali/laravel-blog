<div class="form-group">
    {!! Form::label('name', 'Sub Category Name') !!}
    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Sub Category Slug') !!}
    {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Select Parent Category') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Parent Category'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('order_by', 'Sub Category Serial') !!}
    {!! Form::number('order_by', null, ['class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Sub Category Status') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control'] ) !!}
</div>
