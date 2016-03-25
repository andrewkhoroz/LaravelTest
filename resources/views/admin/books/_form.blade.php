@if(isset($book))
	<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('admin.books.update', $book->id)}}">
	    <input name='_method' type='hidden' value='PUT'>
@else
	<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('admin.books.store') }}">
	    <input name='_method' type='hidden' value='POST'>
@endif
	    {!! csrf_field() !!}

	    <div class="form-group">
	        <label class="col-md-3 control-label">Title</label>

	        <div class="col-md-8">
	        	@if(isset($book))
	            	<input type="text" class="form-control" name="title" value="{{ $book->title }}">
				@else
	            	<input type="text" class="form-control" name="title" value="{{ old('title') }}">
				@endif
                <span class="help-block hide">
                    <strong></strong>
                </span>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-3 control-label">Author</label>
	        <div class="col-md-8">
	            <select class="form-control" name="author_id">
	            	@foreach ($authors as $item)
			        	@if(isset($book))
				        	@if($book->author_id == $item->id)
		            		<option value="{{$item->id}}" selected>{{$item->name}}</option>
							@else
		            		<option value="{{$item->id}}">{{$item->name}}</option>
							@endif
						@else
	            		<option value="{{$item->id}}">{{$item->name}}</option>
						@endif
	            	@endforeach
	            </select>
                <span class="help-block hide">
                    <strong></strong>
                </span>
	        </div>
	    </div>
	    <div class="form-group">
	        <label class="col-md-3 control-label">Year</label>

	        <div class="col-md-8">
	        	@if(isset($book))
	            	<input type="text" class="form-control" name="year" value="{{ $book->year }}">
				@else
	            	<input type="text" class="form-control" name="year" value="{{ old('year') }}">
				@endif
                <span class="help-block hide">
                    <strong></strong>
                </span>
	        </div>
	    </div>
	    <div class="form-group">
	        <label class="col-md-3 control-label">ISBN</label>

	        <div class="col-md-8">
	        	@if(isset($book))
	            	<input type="text" class="form-control" name="isbn" value="{{ $book->isbn }}">
				@else
	            	<input type="text" class="form-control" name="isbn" value="{{ old('isbn') }}">
				@endif

                <span class="help-block hide">
                    <strong></strong>
                </span>
	        </div>
	    </div>

	    <div class="form-group">
	        <div class="col-md-8 col-md-offset-3 text-right">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	            <button type="submit" class="btn btn-success">Save</button>
	        </div>
	    </div>
	</form>

<script type="text/javascript">
	$('.form-horizontal').on('submit', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var _this = $(this);
		var method = _this.find('input[name=_method]').prop('value');
		var url = _this.prop('action');
		var _data = _this.serialize();
		$.ajax({
	    	method: method,
	    	url: url,
		  	data: _data,
		  	dataType: 'json',
		  	success: function(response) {
		  		if (response == 'ok') {
		  			$('#myModal').modal('hide');
		  		};
		  	},
			error: function(data){
				var errors = data.responseJSON;
				$.each(errors, function(key, value) {
					var _name = '[name=' + key + ']';
					var _input = _this.find(_name);
					var _closest = _input.closest('.form-group');
					_closest.addClass('has-error');
					_closest.find('.help-block').removeClass('hide');
					_closest.find('.help-block strong').text(value[0]);
				});
			}
		});
	});
</script>