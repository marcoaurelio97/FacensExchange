
$(document).ready(function(){


	function atualizaSugestaoAmigos(){

		$.ajax({

			url: 'get_sugestao_amigos.php',
			success: function(data){

				$('#sugestao_amigos').html(data);	

				$('.btn_seguir').click(function(){							

					var id_usuario = $(this).data('id_usuario'); //CONSIGO A PARTIR DESTA TAG NOVA DO HTML5 RECUPERAR A PARTIR DO BOTAO O ID DO USUARIO

					$.ajax({

						url: 'adicionar_amigo.php',
						method: 'post',
						data: {amizade_id_usuario: id_usuario},
						success: function(data){
							
							atualizaSugestaoAmigos();
							atualizaAmigos();

						}

					});

				});

				}


			});
			}

			function atualizaAmigos(){

				$.ajax({
					url: 'get_amigos.php',
					success: function(data){

						$('#amigos').html(data);

						$('.btn_desfazer').click(function(){

							if(confirm("Você tem certeza que deseja excluir?")){
								var id_usuario = $(this).data('id_usuario_desfazer'); //CONSIGO A PARTIR DESTA TAG NOVA DO HTML5 RECUPERAR A PARTIR DO BOTAO O ID DO USUARIO
								
								$.ajax({
									url: 'desfazer_amigo.php',
									method: 'post',
									data: {deixar_id_usuario: id_usuario},
									success: function(data){	
			
										atualizaSugestaoAmigos();
										atualizaAmigos();
									}
			
								});
							}
							else{
								return false;
							}



					

				});

					}


				});
			}

			atualizaSugestaoAmigos();
			atualizaAmigos();

		});