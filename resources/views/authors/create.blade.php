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

    <h2>Authors</h2><small>Create new author</small>

    {!! Form::open(['route' => 'authors.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', array('class' => 'col-lg-3 control-label')) !!}
    		<div class="col-lg-7">
        	    {!! Form::text('name', null, array('class' => 'form-control')) !!}
    		</div>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) !!}
        	<div class="col-lg-7">
        	    {!! Form::email('email', null, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('phone', 'Phone', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('phone', null, array('class' => 'form-control', 'placeholder' => '(000) 000-0000
')) !!}
            </div>
        </div>

        <div class="form-group">
    		<div class="col-lg-9 col-lg-offset-3">
    		    {!! Form::submit('Save New Author', array('class' => 'btn btn-primary')) !!}
    	    </div>
    	</div>

    {!! Form::close() !!}

@endsection

@section('footer_scripts')
@endsection