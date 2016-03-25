@extends('layouts.master')

@section('header_meta')
@endsection

@section('style')
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

    <h2>Authors</h2>
    <ol class="breadcrumb" style="margin-bottom: 5px;">
      <li><a href="{!! url('/') !!}">Home</a></li>
      <li class="active">Authors</li>
    </ol>

    <div class="align-left">
        <a href="{!! url('authors/create') !!}">
            <button class="btn btn-info pull-right">New Author</button>
        </a>
    </div>

    <br>&nbsp;

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
              <tr>
                <td><a href="authors/{{ $author->id }}">{{ $author->id }}</a></td>
                <td><a href="authors/{{ $author->id }}">{{ $author->name }}</a></td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->phone }}</td>
              </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('footer_scripts')
@endsection