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

    <h2>Authors</h2>

    <ol class="breadcrumb" style="margin-bottom: 5px;">
      <li><a href="{!! url('/') !!}">Home</a></li>
      <li><a href="{!! url('authors') !!}">Authors</a></li>
      <li class="active">Edit Author {{ $author->id }}</li>
    </ol>

    <br>&nbsp;
    <br>&nbsp;

    {!! Form::open(['url' => 'authors/' . $author->id, 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', array('class' => 'col-lg-3 control-label')) !!}
    		<div class="col-lg-7">
        	    {!! Form::text('name', $author->name, array('class' => 'form-control')) !!}
    		</div>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) !!}
        	<div class="col-lg-7">
        	    {!! Form::email('email', $author->email, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('phone', 'Phone', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('phone', $author->phone, array('class' => 'form-control', 'placeholder' => '(000) 000-0000
                                                                                       ')) !!}
            </div>
        </div>

        <div class="form-group">
    		<div class="col-lg-9 col-lg-offset-3">
    		    {!! Form::submit('Update Author', array('class' => 'btn btn-primary')) !!}
    	    </div>
    	</div>

    {!! Form::close() !!}

@endsection

@section('footer_scripts')
@endsection