@extends('layouts.master')
@section('title')
	Book Managerment
@endsection
@section('content')

<h1 align="center">Book Managerment</h1>

<a href="{{ route('admin.books.create') }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create</a>
<table class="table table-bordered">
	<thead data-url="http://booklibrary.local/admin/books?page=1">
		<th>#</th>
		<th data-orderby='title' data-order='asc'>Title
			<span class='desc'>&darr;</span>
			<span class='asc'>&uarr;</span>
		</th>
		<th data-orderby='au.name' data-order='asc'>Author
			<span class='desc'>&darr;</span>
			<span class='asc'>&uarr;</span>
		</th>
		<th data-orderby='year' data-order='asc'>Year
			<span class='desc'>&darr;</span>
			<span class='asc'>&uarr;</span>
		</th>
		<th data-orderby='isbn' data-order='asc'>ISBN
			<span class='desc'>&darr;</span>
			<span class='asc'>&uarr;</span>
		</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach ($response['data'] as $k=>$book)
		<tr>
			<td>{{ ($k + 1) + 2*($page-1) }}</td>
			<td>{{ $book['title'] }}</td>
			<td>{{ $book['author'] }}</td>
			<td>{{ $book['year'] }}</td>
			<td>{{ $book['isbn'] }}</td>
			<td>
				<a href="{{ route('admin.books.edit', $book['id']) }}" class="btn btn-warning" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit</a>
				<a href="{{ route('admin.books.destroy', $book['id']) }}" class="btn btn-danger">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="text-center">
	<ul class="pagination">
		<li class="disabled prev">
			<a href="/admin/books?page=1">«</a>
		</li>
		@for ($i = 1; $i <= $lastPage; $i++)
			<li class="{{($i==1) ? 'active' : ''}}">
				<a href="/admin/books?page={{$i}}">{{$i}}</a>
			</li>
		@endfor
		<li class='next'>
			<a href="/admin/books?page=2">»</a>
		</li>
	</ul>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Done</h4>
      </div>
      <div class="modal-body" id="response">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
    	Are you sure?
      </div>
      <div class="modal-footer">
	    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
	    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
	$('#myModal').on('hidden.bs.modal', function (e) {
        $('#myModal').removeData('bs.modal');
	});

	var current_page = 1;
	paginationMethod();

	deleteMethod();

	$('.table thead th').on('click', function (e) {
		if ($(this).hasClass('desc')) {
			$('.table thead th').removeClass();
			$(this).attr('data-order', 'asc');
			$(this).addClass('asc order');
			var _url = $('.table thead').data('url') + '&orderBy=' + $(this).data('orderby') + '&order=asc'; 
		} else{
			$('.table thead th').removeClass();
			$(this).attr('data-order', 'desc');
			$(this).addClass('desc order');
			var _url = $('.table thead').data('url') + '&orderBy=' + $(this).data('orderby') + '&order=desc'; 
		};
	    list(_url);
	})

	function deleteMethod() {
		$('.btn-danger').on('click', function(e){
			var _this = $(this);
		    e.preventDefault();
		    $('#confirm').modal({ 
		    	backdrop: 'static', 
		    	keyboard: false,
		    	show: true
		    })
		    .one('click', '#delete', function() {
				$.ajax({
			    	method: 'DELETE',
			    	url: _this.prop('href'),
			  		data: {
			  			_token: '{{ csrf_token() }}'
			  		},
				  	success: function(response) {
				  		_this.closest('tr').remove();
				  	},
					error: function(data){
						var errors = data.responseJSON;
	            		console.log(errors);
					}
				});
	        });
		});
	}

	function paginationMethod() {
		$('.pagination a').on('click', function(e) {
		    e.preventDefault();
		    var _this = $(this);
		    if(_this.parent().hasClass('disabled') || _this.parent().hasClass('active')){
         		return;
		    }
		    var _url = _this.prop('href');
		    if ($('.table thead th').hasClass('order')) {
			    var _orderBy = $('.table thead th.order').data('orderby');
			    var _order = $('.table thead th.order').data('order');
			    _url = _url + '&orderBy=' + _orderBy + '&order=' +_order;
		    };
		    list(_url);
		})
	}

	function list(_url) {
		$.ajax({
	    	method: 'GET',
	    	url: _url,
	  		data: {
	  			_token: '{{ csrf_token() }}'
	  		},
		  	success: function(response) {
		  		// remove old records
		  		$('.table tbody').empty();

		  		// set variables
		  		var obj = jQuery.parseJSON(response);
		  		var current_page = obj.current_page;
		  		var last_page = obj.last_page;
		  		var per_page = obj.per_page;
		  		var prev_page_url = obj.prev_page_url;
		  		var next_page_url = obj.next_page_url;
		  		var data = obj.data;

		  		// handle pagination link
		  		$(".pagination li").removeClass('disabled active');
		  		$(".pagination li.prev a").attr('href',prev_page_url);
		  		$(".pagination li.next a").attr('href',next_page_url);
		  		if (current_page == last_page) {
		  			$(".pagination li.next").addClass('disabled');
		  		};
		  		if (current_page == 1) {
		  			$(".pagination li.prev").addClass('disabled');
		  		};
		  		var _eq = '.pagination li:eq(' + current_page + ')';
	    		$(_eq).addClass('active');

		  		// replace new records
		  		$.each(data, function( index, value ) {
		  			var index = (index+1)+per_page*(current_page-1);
		  			var hrefEdit = '/admin/books/' + value.id + '/edit';
		  			var hrefDelete = '/admin/books/' + value.id;
		  			var html = '<tr>' + 
									'<td>' + index + '</td>' + 
									'<td>' + value.title + '</td>' + 
									'<td>' + value.author + '</td>' + 
									'<td>' + value.year + '</td>' + 
									'<td>' + value.isbn + '</td>' + 
									'<td>' + 
										'<a href="' + hrefEdit + '" class="btn btn-warning" data-toggle="modal" data-target="#myModal" style="margin-right: 5px;">Edit</a>' + 
										'<a href="' + hrefDelete + '" class="btn btn-danger">Delete</a>' + 
									'</td>' + 
								'</tr>'
		  			$('.table tbody').append(html);
				});
				deleteMethod();
		  	},
			error: function(data){
				var errors = data.responseJSON;
        		console.log(errors);
			}
		});
	}
</script>
@endsection