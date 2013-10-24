<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	
    <title>Black Friday Run</title>
	
	<meta name="description" content="Black Friday Run online Game">
	<meta name="keywords" content="game, black friday, runner">
	
	<link rel="stylesheet" type="text/css" href="view/style.css">
	
	<?php 
		// Inclusion des librairies externes
		jsLibrairies('jquery', $config['js-libs']['jquery']) ; 
		jsLibrairies('jquery-ui', $config['js-libs']['jquery-ui']) ; 
	?>
	
	<script>
	
	/* AJAX */
	$(document).ready(function() {
    $('.menu_button').on('click', function() {	 
			var input = $('#input').val();
			var algo = $('#methode').val();
	 
			if(input == '' || algo == '') {
				alert('Les champs doivent êtres remplis');
			} else {
				$.ajax({
					url: $(this).attr('action'),
					type: $(this).attr('method'),
					data: $(this).serialize(),
					dataType: 'json',
					success: function(json) {
						if(json.success == 'ok') {
							$("div#content").prepend(json.html);
						} else {
							alert('Erreur : '+ json.success);
						}
					}
				});
			}
			return false;
		});
	});
	
	</script>
	
	
</head>

<body>