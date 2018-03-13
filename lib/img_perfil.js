$(document).ready(function(){
	
	$('#btn_img_perfil_editar').click(function(){
		event.preventDefault();
		var postData = new FormData($("#form_edita_perfil")[0]);
		$.ajax({
			url: "edita_img_perfil.php",
			type: "POST",
			data: postData,
   processData: false,  // tell jQuery not to process the data
   contentType: false
}).done(function(msg) {	
	                     location.reload();

	atualizaEditaImgPerfil();		
});
});

	$('#btn_img_perfil_cadastrar').click(function(){
		event.preventDefault();
		var postData = new FormData($("#form_edita_perfil")[0]);
		$.ajax({
			url: "cadastra_img_perfil.php",
			type: "POST",
			data: postData,
   processData: false,  // tell jQuery not to process the data
   contentType: false
}).done(function(msg) {		
	 location.reload();
	atualizaEditaImgPerfil();		
});
});

function atualizaEditaImgPerfil(){

		$.ajax({					
			url: 'get_img_perfil.php',
			success: function(data){				
				$('#img_perfil_editar_default').hide();
				$('#img_perfil_editar').html(data);		

			}

		});
	}

});