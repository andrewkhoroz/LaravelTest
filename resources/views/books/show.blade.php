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

    <h2>Books</h2>

    <ol class="breadcrumb" style="margin-bottom: 5px;">
      <li><a href="{!! url('/') !!}">Home</a></li>
      <li><a href="{!! url('books') !!}">Books</a></li>
      <li class="active">Book {{ $book->id }}</li>
    </ol>

    <div align="right">
        <a href="{!! url('books/' . $book->id . '/edit') !!}">
            <button class="btn btn-info">Edit Book</button>
        </a>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete Book</button>
    </div>

    <br>&nbsp;
    <br>&nbsp;

    <div class="row">
        <div class="col-sm-3"></div>

        <div class="col-sm-6">
          <div class="panel panel-info">
            <div class="panel-heading">Title : {{ $book->title }}</div>
            <div class="panel-body">
                <p>Author : {{ $book->getAuthor->name }}</p>
                <p>Year   : {{ $book->year }}</p>
                <p>ISBN   : {{ $book->isbn }}</p>
            </div>
          </div>

        </div>
        <div class="col-sm-3"></div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Book</h4>
          </div>
          <div class="modal-body">
            <p>Do you want to delete the Book - {{ $book->title }} ?</p>
          </div>
          <div class="modal-footer">
            {!! Form::open(array('url' => '/books/' . $book->id, 'method' => 'DELETE')) !!}
              <button class="btn btn-default">Yes</button>
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>

      </div>
    </div>

@endsection

@section('footer_scripts')
@endsection