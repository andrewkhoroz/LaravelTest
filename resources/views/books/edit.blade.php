@extends('layouts.master')

@section('header_meta')
@endsection

@section('style')
@endsection

@section('content')

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <h2>Book</h2>

    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{!! url('/') !!}">Home</a></li>
        <li><a href="{!! url('books') !!}">Books</a></li>
        <li class="active">Edit Book {{ $book->id }}</li>
    </ol>

    <br>&nbsp;
    <br>&nbsp;

    {!! Form::open(['url' => 'books/' . $book->id, 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
    		<div class="col-lg-7">
        	    {!! Form::text('title', $book->title, array('class' => 'form-control')) !!}
    		</div>
        </div>

        <div class="form-group">
            {!! Form::label('author', 'Author', array('class' => 'col-lg-3 control-label')) !!}
        	<div class="col-lg-7">
        	    {!! Form::select('author', $authors, $book->author, ['class' => 'form-control']) !!}
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

@endsection

@section('footer_scripts')
@endsection