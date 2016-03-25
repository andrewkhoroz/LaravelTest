@extends('layouts.master')

@section('header_meta')
@endsection

@section('style')
    <link href="{!! url('assets/dataTables/css/jquery.dataTables.min.css') !!}" rel="stylesheet">
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

    <h2>Books</h2>

    <ol class="breadcrumb" style="margin-bottom: 5px;">
      <li><a href="{!! url('/') !!}">Home</a></li>
      <li class="active">Books</li>
    </ol>

    <div class="align-left">
        <a href="{!! url('books/create') !!}">
            <button class="btn btn-info pull-right">New Book</button>
        </a>
    </div>

    <br>&nbsp;

    <table id="books-table" class="table table-striped table-hover table-responsive">
        <thead class="vd_bg-dark-blue">
        <tr class="heading">
            <th>
                <div class="vd_checkbox">
                    <input type="checkbox" id="checkbox-0">
                    <label for="checkbox-0"></label>
                </div>
            </th>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>ISBN</th>
        </tr>
        <tr class="filter">
            <th>
                <div class="vd_checkbox">
                    <input type="checkbox" id="checkbox-1">
                    <label for="checkbox-1"></label>
                </div>
            </th>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>ISBN</th>
        </tr>
        </thead>
    </table>

@endsection

@section('footer_scripts')
    <!-- Specific Page Scripts Put Here -->
    <script src="{!! url('/assets/dataTables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! url('/assets/dataTables/dataTables.bootstrap.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var options = {
                "processing": true,
                "dom": "<'row mgbt-xs-0'<'col-md-8 col-sm-12'li><'col-md-4 col-sm-12'p>>r<'table-scrollable't><'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'p>>r", // datatable layout
                "autoWidth": false,
                "ajax": {
                    "url": "books/getlist",
                    "type": "POST",
                    "dataSrc": ""
                },
                "language": { // language settings
                    "lengthMenu": "Show &nbsp; _MENU_ ",
                    "info": "of _TOTAL_ records"
                },
                "columns": [

                    {  "data": "id",
                        "render": function ( data, type, full, meta ) {
                            return '<div class="vd_checkbox"><input type="checkbox" class="checkbox-group" id="'+data+'"><label for="'+data+'"></label></div>';}
                    },
                    { "data": "id",
                        "render": function ( data, type, full, meta ) {
                            return '<a href="books/'+full.id+'">'+data+'</a>';}
                    },
                    { "data": "title",
                        "render": function ( data, type, full, meta ) {
                            return '<a href="books/' + full.id + '">'+data+'</a>';}
                    },
                    { "data": "author_name" },
                    { "data": "year" },
                    { "data": "isbn" }
                ],
                "columnDefs": [
                    { "width": "20", "targets": [0] },
                    { "width": "20", "targets": [1] },
                    { "width": "200", "targets": [2] },
                    { "width": "60", "targets": [3] },
                    { "width": "80", "targets": [4,5] },
                    { "orderable": false, "targets": [0]},
                ],
                "orderCellsTop": true,
                "order": [[ 1, "asc" ]]
            };
            var table = $('#books-table').DataTable(options);

            // After Init Completed
            table.on( 'init.dt', function () {

                $('#books-table thead .filter th').each( function (thindex) {

                    var title = $('#books-table thead th').eq( thindex ).text();

                    var nchild = $(this).parent().children().length ; // how many children

                    if (thindex == 0  || thindex == 1){
                        $(this).html( '' );
                    }

                    // Add Button
                    else if (thindex == nchild-1){
                        $(this).html( '<div style="width:100px"><a data-toggle="tooltip" data-original-title="Search" id="search-btn" class="btn vd_btn vd_round-btn btn-xs vd_bg-green append-icon" style="margin-top:-10px;"><i class="fa fa-search fa-fw "></i></a> <a data-toggle="tooltip" data-original-title="Clear Filter" id="filter-reset-btn" class="btn vd_btn vd_round-btn btn-xs vd_bg-yellow" style="margin-top:-10px;"><i class="fa fa-undo fa-fw "></i></a></div>' );

                        // Add and Apply Select
                    } else if (thindex == 3 || thindex == 4) {
                        var select = $('<select><option value=""></option></select>')
                                .appendTo( $(this).empty() ) // empty the column
                                .on( 'change', function () {
                                    // use bottom if you want to search on type
                                    if ($(this)[0].selectedIndex > 0){
                                     table.column( thindex )
                                     .search( '^'+$(this).val()+'$', true, false )
                                     .draw();
                                     } else {
                                     table.column( thindex )
                                     .search( '' )
                                     .draw();
                                     }
                                } );
                        table.column( thindex ).data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                        // Add Input
                    } else {
                        var input= $( '<input type="text" class="input-sm" placeholder="Search '+title+'" />' )
                                .appendTo( $(this).empty() )
                                .on( 'keyup change', function () {
                                    // use bottom if you want to search on type
                                    						table.column( thindex )
                                     .search( this.value )
                                     .draw();
                                });
                    }

                    // End Th Each Function
                });

                $('#filter-reset-btn').click(function(e) {
                    e.preventDefault();
                    resetFilter();
                });

                $('#search-btn').click(function(e) {
                    e.preventDefault();
                    searchTable();
                });


                $('#checkbox-0').click(function() {
                    if($(this).is(':checked'))
                        $('.checkbox-group').prop('checked', true).closest("tr").addClass('row-warning');
                    else
                        $('.checkbox-group').prop('checked', false).closest("tr").removeClass('row-warning');
                });

                $('.checkbox-group').click(function() {
                    if($(this).is(':checked'))
                        $(this).closest("tr").addClass('row-warning');
                    else
                        $(this).closest("tr").removeClass('row-warning')
                });

                $('.pagination').addClass('pagination-sm');

                // End Init Completed
            });


            function resetFilter() {
                $('#books-table thead .filter th').each( function (thindex) {
                    $(this).children('input,select').val("");
                    table.column(thindex).search('').draw();
                });
                $('#books-table [type="checkbox"]').attr("checked", false);
            }
            function searchTable() {
                // reset first
                $('#books-table thead .filter th').each( function (thindex) {
                    table.column(thindex).search('').draw();
                });

                // search
                $('#books-table thead .filter th').each( function (thindex) {
                    var value = $(this).children('input,select').val();

                    if (value != '' && value !=null){

                        if (thindex == 4 ) {
                            table.column( thindex ).search( '^'+value+'$', true, false )
                        } else{
                            table.column(thindex).search(value);
                        }
                    }
                });
                table.draw();
            }
        } );
    </script>
    <!-- Specific Page Scripts END -->
@endsection