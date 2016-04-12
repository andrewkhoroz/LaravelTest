$(document).ready(function() {
    $('#book-shelf').DataTable( );
    
    $('.remove').click(function(){
        id = $(this).parent().find('.id').html();
        return location.href = 'remove?id='+id;
    });
    
    $('.edit').click(function(){
        id = $(this).parent().find('.id').html();
        return location.href = 'edit?id='+id;
    }); 
});
