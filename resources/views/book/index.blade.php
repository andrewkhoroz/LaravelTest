@include('includes.head')
<div class="container">
           
            <div class="col-sm-10">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Success!</strong> {{ Session::get('message') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Book List
                    </div>
                <div class="panel-body">

                    <table id="active" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Year</th>
                                <th>ISBN</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>                         
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author->name }}</td>
                                    <td>{{ $book->year }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td><a href="#" class="delete" data-book-id="{{ $book->id }}">Delete</a></td>
                                    <td><a href="/edit-book/{{ $book->id }}" class="edit">Edit</a></td>
                                </tr>
                            @endforeach 
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="/add-book"><input type="button" class="btn btn-primary" value="Add Book" /></a>
        </div>
    </div>
</div>
@section('scripts')
<script>
    jQuery(document).ready(function($) {        

        $('body').on('click', '.delete', function(event) {
            /* Act on the event */
            event.preventDefault();
            var bookId = $(this).data('book-id');
            var $this = $(this);
            var confirm1 = confirm('Are you sure you want to delete this book?');

            if (confirm1) {  
     
                $.ajax({
                    
                    url: '/delete-book',
                    type: 'POST',
                    data: {bookId: bookId},
                    success: function(html) {
                        $this.closest('tr').remove();
                        alert('Book has been deleted')
                    }

                }).fail(function(error) {
                    console.log(error);
                })
            }
            
        });
    });
</script>
@stop
@include('includes.footer')