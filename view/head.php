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
		$(document).ready(function()
		{
			$('.menu_button').on('click', function() {	 
					var page = $(this).attr('id');

						$.ajax({
							url: $(this).attr('action'),
							type: 'POST',
							data: 'page='+page,
							dataType: 'html',
							
							success: function(html)
							{
								$("#content").html(html);
							}
							
						});
					return false;
				});
		});
	
	</script>
	
	
</head>

<body>