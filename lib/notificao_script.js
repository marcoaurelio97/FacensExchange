$(document).ready(function(){

	
	
	
	function atualizaNotificacao(){
		
		$.ajax({

			url: 'get_notificacao.php',
			success: function(data){

				$('#notificacao').html(data);	

				$('.btn_aceita_convite').click(function(){

					var id_usuario = $(this).data('id_usuario'); //CONSIGO A PARTIR DESTA TAG NOVA DO HTML5, RECUPERAR A PARTIR DO BOTAO O ID DO USUARIO
					
					$.ajax({

						url: 'aceitar_amigo.php',
						method: 'post',
						data: {aceitar_amizade_id_usuario: id_usuario},
						success: function(data){
							
							atualizaNotificacao();

						}

					});

				});

				$('.btn_recusa_convite').click(function(){
					
					var id_usuario = $(this).data('id_usuario_recusa'); //CONSIGO A PARTIR DESTA TAG NOVA DO HTML5 ,RECUPERAR A PARTIR DO BOTAO O ID DO USUARIO
					$.ajax({

						url: 'recusar_amigo.php',
						method: 'post',
						data: {recusar_amizade_id_usuario: id_usuario},
						success: function(data){
							
							atualizaNotificacao();

						}

					});

				});

				$('.btn_ok').click(function(){
					
					var id_usuario = $(this).data('id_usuario'); //CONSIGO A PARTIR DESTA TAG NOVA DO HTML5 ,RECUPERAR A PARTIR DO BOTAO O ID DO USUARIO
					
					$.ajax({

						url: 'visualizar_resposta.php',
						method: 'post',
						data: {id_usuario: id_usuario},
						success: function(data){
							
							atualizaNotificacao();

						}

					});

				});




			}

		});

		


	}

	atualizaNotificacao();

});

$(function() {
		setTime();
		function setTime() {
			var date = new Date().getTime();
			var string = "Timestamp: "+date;
			setTimeout(setTime, 5000);
			$('#qtd').html(string);
		}
	});