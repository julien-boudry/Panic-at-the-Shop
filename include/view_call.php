<?php

	IF ( !isset($_POST['page']) )
	{
		require_once 'view/head.php' ;
		
		require_once 'view/header.php' ;
		
		require_once 'view/game.php' ;
		
		require_once 'view/footer.php' ;
	}
	
	ELSE
	{
		IF ( $_POST['page'] == 'page_game' )
		{
			require_once 'view/game.php' ;
		}
		ELSEIF ( $_POST['page'] == 'page_score' )
		{
			require_once 'view/score.php' ;
		}
		ELSEIF ( $_POST['page'] == 'page_about' )
		{
			require_once 'view/about.php' ;
		}
		
		
		
		
	}