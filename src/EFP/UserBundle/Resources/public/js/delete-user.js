
$(document).ready(function(){ // esto se hace para cargar el documento, la pagina

    $('.btn-delete').click(function(e){ //  clase de boton
        e.preventDefault(); // evitar recarga de pagina
        
        var row = $(this).parents('tr');
        var id = row.data('id');

        var form = $('#form-delete');
        
        var url = form.attr('action').replace(':USER_ID', id);
        
        var data = form.serialize(); // serializa form no se para que sirve.
        bootbox.confirm(message, function(res) {
            if(res == true){
                $.post(url, data, function(result){ 
                    if(result.removed == 1){
                        row.fadeOut();
                        $('#message').removeClass('hidden');
                        
                        $('#user-message').text(result.message);
                        
                        var totalUsers = $('#total').text();
                        
                        if($.isNumeric(totalUsers)){
                            $('#total').text(totalUsers - 1);
                        }else{
                            $('#total').text(result.countUsers);
                        }
                    }else{
                        $('#message-danger').removeClass('hidden');
                        
                        $('#user-message-danger').text(result.message);
                    }
                }).fail(function(){
                    alert('ERROR');
                    row.show();
                });
            }
        });
        
    });
    
});
