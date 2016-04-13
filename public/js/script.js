$(document).ready(function() {
    $('#book-shelf').DataTable( );
    
    $('.remove').click(function(){
        id = $(this).parent().find('.id').html();
        var obj = $(this).parent().find('.id').parent();
        var confirmDeleting = confirm('You really want to delete this book?');
          if (confirmDeleting) {  
                $.ajax({
                    url: 'remove',
                    type: 'POST',
                    data: {id:id}
                    }).done(function(msg){
                            if( msg === "OK"){
                                obj.css('display','none');
                            }else{
                                alert(msg);
                            }  
                        });
                    }
    });
    
    $('.edit').click(function(){
        id = $(this).parent().find('.id').html();
        return location.href = 'edit?id='+id;
    }); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
