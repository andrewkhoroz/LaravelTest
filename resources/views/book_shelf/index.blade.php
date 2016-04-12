@extends('app')

@section('content')
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
                        <th class="id">ID</th>
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
                        echo "<td class='id'>$book->id</td>";
                        echo "<td>$book->title</td>";
                        $author = $book->author;
                        echo "<td>$author->name</td>";
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
   @stop