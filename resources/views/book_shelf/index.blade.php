<!DOCTYPE html>
<html>
    <head>
        <title>Book Shelf</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function() {
                $('#book-shelf').DataTable( );
                
                var isbn;
                $('.remove').click(function(){
                    isbn = $(this).parent().find('.isbn').html();
                    var obj = $(this).parent().find('.isbn').parent();
                    var confirmDeleting = confirm('You really want to delete this book?');
         
                    if (confirmDeleting) {  
                        $.ajax({
                            url: 'index/remove',
                            type: 'POST',
                            data: {isbn:isbn}
                                })
                        .done(function(msg){
                            if( msg === "OK"){
                                obj.css('display','none');
                            }else{
                                alert(msg);
                            }  
                        })
                    }
                    });
                
                $('.edit').click(function(){
                    isbn = $(this).parent().find('.isbn').html();
                    return location.href = 'edit?isbn='+isbn;
                });
            });
        </script>
        
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                margin-top: 15px;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Open Sans', sans-serif;
            }
            
            table{
                cursor: pointer;
            }
            
            .add{
                margin-bottom: 10px;
            }
            
        </style>
    </head>
    
    <body method="post">
        <div class="container">
            <div class="add">
                <a href="add" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus"></span> Add 
                </a>     
            </div>
        </div>
        
        <div class="container">
            <table class="table table-hover" id="book-shelf" method="post">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>ISBN</th>
                        <th><span class='glyphicon glyphicon-remove-sign'></span></th>
                        <th><span class="glyphicon glyphicon-pencil" id="update"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($books as $book)
                    {
                        echo "<tr>";
                        echo "<td>$book->title</td>";
                        echo "<td>$book->author</td>";
                        echo "<td>$book->year</td>";
                        echo "<td class='isbn'>$book->isbn</td>";
                        echo "<td class='remove'><a href='#'><span class='glyphicon glyphicon-remove-sign'></span></a></td>";
                        echo "<td class='edit'><a href='#'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
