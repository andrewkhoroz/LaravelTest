<!DOCTYPE html>
<html>
    <head>
        <title>Edit Book</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
    </head>
    
    <script>
       $(document).ready(function(){ 
          
         (function() {
            var app = {
		
		      initialize : function () {			
			     this.modules();
			     this.setUpListeners();
		      },
 
		      modules: function () {
 
              },
 
               setUpListeners: function () {
			      $('form').on('submit',app.submitForm);
                  $('form').on('keydown','input',app.removeError);
		       },
 
		      submitForm: function (e) {
			      e.preventDefault();
                  var form = $(this),
                      submitBtn = form.find('button[type="submit"]');
                  
                  submitBtn.attr('disabled','disabled');
                  
                  var str = form.serialize();
                  str+='&id=';                 
                  str+= '<?php echo $book->id; ?>';
                  str+='&oldAuthor=';                 
                  str+= '<?php echo $book->author_id; ?>';
                  console.log(str);
                  $.ajax({
                      url: 'update',
                      type: 'POST',
                      data: str
                  })
                  .done(function(msg){
                    if( msg === "OK"){
                        var result = "Book has been edited!)"; 
                        document.getElementById('result').innerHTML = result;
                        return location.href = 'index';
                    }else{
                        document.getElementById('result').innerHTML = msg;
                    }  
                  })
                  .always(function(){
                     submitBtn.removeAttr('disabled'); 
                  });
		      }
		
	       };
 
	app.initialize();
 
}());
           });
    </script>
    
    <style>
        .add{
            margin-top: 10px;
        }
        
        .tooltip-inner{
            white-space: pre;
        }
        
        form{
            width: 90%;
        }
        
    </style>
    
    <body>
        <div class="container">
            <div class="add">
                <a href="index" class="btn btn-info btn-lg">
                    <span class="glyphicons glyphicons-home"></span>Home 
                </a>     
            </div>
        </div>
        
        <div class="container">
            <h2 id="result">Edit book</h2>
                <form role="form" id="form" method="post">
                    <div class="form-group">
                        <label for="title">Title*:</label>
                        <input type="title" class="form-control" id="title" placeholder="Enter title" name="title" value='<?php echo $book->title?>'>
                    </div>
                    <div class="form-group">
                        <label for="author">Author name*:</label>
                        <input type="text" class="form-control" id="author" placeholder="Enter author's name" name="author" value='<?php 
                        $author = $book->author;
                        echo $author->name?>'>
                    </div>
                    <div id="author-info">
                    <div class="form-group">
                        <label for="email">Author's email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter author's email" name="email" value='<?php 
                        echo $author->email?>'>
                    </div>
                    <div class="form-group">
                        <label for="phone">Author's phone:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter author's phone" name="phone" value='<?php 
                        echo $author->phone?>'>
                    </div>
                        </div>
                    <div class="form-group">
                        <label for="year">Year*:</label>
                        <input type="text" class="form-control" id="year" placeholder="Enter year of publishing" name="year" value='<?php echo $book->year?>'>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN*:</label>
                        <input type="text" class="form-control" id="isbn" placeholder="Enter isbn" name="isbn" value='<?php echo $book->isbn?>'>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
        </div>
    </body>
</html>