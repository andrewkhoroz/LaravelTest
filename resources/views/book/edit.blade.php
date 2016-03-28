@include('includes.head')
<div class="container">
  
        <div class="col-sm-10">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Success!</strong> {{ Session::get('message') }}
                </div>
            @endif

            {!! Form::open(array('method' => 'post'))!!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Add/Edit Book</h5>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title">Title</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="input-group">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required value="{{ $book->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title">Author</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="input-group">
                                            {{ Form::select('author_id', $authors, $book->author_id, ['id' => 'author_id', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title">Year</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="input-group">
                                            <input type="number" name="year" id="year" class="form-control" placeholder="Year" required value="{{ $book->year }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title">ISBN</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="input-group">
                                            <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN" required value="{{ $book->isbn }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('includes.footer')