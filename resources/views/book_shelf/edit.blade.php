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
        @include('add_edit_form')
    {!! Form::close() !!}
</div>
@stop