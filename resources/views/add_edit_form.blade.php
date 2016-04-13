       <div class="form-group id" >
            {!! Form::label('id', 'ID', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('id', $book->id, array('class' => 'form-control')) !!}
            </div>
        </div> 
        <div class="form-group">
            {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('title', $book->title, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('author', 'Author', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::select('author', $authors, $book->author,  ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('year', 'Year', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('year', $book->year, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('isbn', 'ISBN', array('class' => 'col-lg-3 control-label')) !!}
            <div class="col-lg-7">
                {!! Form::text('isbn', $book->isbn, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            </div>
        </div>
