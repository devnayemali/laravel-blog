<div class="form-group">
    {!! Form::label('name', 'Category Name') !!}
    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Category Slug') !!}
    {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('order_by', 'Category Serial') !!}
    {!! Form::number('order_by', null, ['class' => 'form-control form-control-user mb-1']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Category Status') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control'] ) !!}
</div>
