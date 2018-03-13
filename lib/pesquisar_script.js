$(document).ready(function(){   

    $('#btn_pesquisar').click(function(){
        
        if($('#pesquisar_txt').val().length > 0){           
            $.ajax({
                url: 'pesquisar_usuarios.php',
                type: 'POST',
                data: $('#form_pesquisar').serialize(),
                success: function(data){
                             
                   $('#div_home').html(data);
                   
                }
            });
        }
        
});

});