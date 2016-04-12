@extends('app')

@section('content')
        
<div class="container">
    <div class="add">
        <a href="index" class="btn btn-info btn-lg">
        <span class="glyphicons glyphicons-home"></span>Home 
        </a>     
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2>Edit book</h2>
    {!! Form::open(['url' => 'update', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <div class="form-group id" >
            {!! Form::label('id', 'ID', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('id', $book->id, array('class' => 'form-control')) !!}
            </div>
        </div> 
        <div class="form-group">
            {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('title', $book->title, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('author', 'Author', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::select('author', $authors, $book->author,  ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('year', 'Year', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('year', $book->year, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('isbn', 'ISBN', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('isbn', $book->isbn, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                {!! Form::submit('Update Book', array('class' => 'btn btn-primary')) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@stop