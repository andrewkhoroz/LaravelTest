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

    <h2>Books</h2><small>Create new book</small>

    {!! Form::open(['route' => 'books.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
    		<div class="col-lg-7">
        	    {!! Form::text('title', null, array('class' => 'form-control')) !!}
    		</div>
        </div>

        <div class="form-group">
            {!! Form::label('author', 'Author', array('class' => 'col-lg-3 control-label')) !!}
        	<div class="col-lg-7">
        	    {!! Form::select('author', $authors, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('year', 'Year', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('year', null, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('isbn', 'ISBN', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('isbn', null, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
    	    <div class="col-lg-9 col-lg-offset-3">
    		    {!! Form::submit('Save New Book', array('class' => 'btn btn-primary')) !!}
    		</div>
    	</div>

    {!! Form::close() !!}

<br>&nbsp;
Would be great to have this paied plugin to validate ISBN -> <a href="http://formvalidation.io/validators/isbn/" target="_blank">http://formvalidation.io/validators/isbn/</a>
<br>&nbsp;

@endsection

@section('footer_scripts')
@endsection