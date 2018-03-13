$(document).ready(function () {


	$('#btn_post').click(function () {
		event.preventDefault();
		var postData = new FormData($("#form_post")[0]);

		$.ajax({
			url: "inclui_post.php",
			type: "POST",
			data: postData,
			processData: false,
			contentType: false
		}).done(function (msg) {
			atualizaPost();
			$('$texto_post').val('');
			$('$titulo_post').val('');

		});
	});

	function atualizaPost() {

		$.ajax({
			url: 'get_post.php',
			success: function (data) {
				$('#posts').html(data);
			}

		});
	}

	function atualizaComentarios() {
		var id_post = $('#id_post').val();
		$.ajax({
			url: 'get_comentarios.php',
			type: "POST",
			data: {
				id_post_comentario: id_post
			},
			success: function (data) {
				$('#comentarios').html(data);
			}

		});
	}



	$('#btn_comentar').click(function () {

		if ($('#comentario_post').val().length > 0) {
			event.preventDefault();
			var postData = new FormData($("#form_comentario")[0]);

			$.ajax({
				url: "inclui_comentario.php",
				type: "POST",
				data: postData,
				processData: false,
				contentType: false
			}).done(function (msg) {
				atualizaComentarios();
				$('#comentario_post').val('');
				$('#imagem_comentario').val('');



			});
		}

	});
	


	$("#posts").click(function () {

		$(".post_excluir").click(function(){	

		var id_post = $(this).data('id_post');	

		$.ajax({
			url: 'excluir_post.php',
			method: 'POST',
			data: {	id_post_excluir: id_post},
			success: function (data) {
				atualizaPost();
			}

		});


	});
});

$("#comentarios").click(function () {
	
			$(".post_excluir").click(function(){	

			var id_post = $(this).data('id_comentario');	
	
			$.ajax({
				url: 'excluir_comentario.php',
				method: 'POST',
				data: {	id_comentario_excluir: id_post},
				success: function (data) {
					atualizaComentarios();
				}
	
			});
	
	
		});
	});




	atualizaComentarios();
	atualizaPost();

});