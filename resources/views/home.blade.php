@extends('layouts.master')

@section('header_meta')
@endsection

@section('style')
@endsection

@section('content')

In order to make this WepApp work, please correct .env DB definitions..<br>
<p></p>
This <i>.env</i> file will be on repository, as I removed it from .gitignore.. debug mode is off..<br>
<p>After running -> composer install  ..</p>

Run :<br>
-> php artisan migrate<br>
-> php artisan db:seed --class=AuthorsTableSeeder<br>
-> php artisan db:seed --class=BooksTableSeeder<br>
<br>
<p>At this point, there must be 80 books and 20 authors..</p>
<br>
<p>The book's list, is loaded and done with jquery dataTable..</p>
<br>
Form's are generated with Laravel Collective packadge<br>
-> https://laravelcollective.com/<br>
<p>&nbsp;</p>
There is validation on Authors Phone Number, based on US phone rules, using this packadge :<br>
-> https://github.com/Propaganistas/Laravel-Phone<br>
<p>&nbsp;</p>
If for any reason, the preference should be only 'required|numeric' or 'required'for this field,<br>
these need to be re-coded on AuthorsController, on store and update functions..<br>
<br>
<p>Design is simple, based on Twitter Bootstrap.</p>
<br>
Best Regards<br>
Luis Santos<br>

@endsection

@section('footer_scripts')
@endsection