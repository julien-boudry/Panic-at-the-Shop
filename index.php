<?php

	// Config
	
		require_once 'config.php' ;
	
	// Fonctions && Class
	
		require_once 'include/functions.php' ;
		
		// Chargement automatique des classes		
			spl_autoload_register('chargerClasse') ; // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

	
	// Aiguillage API vs WEB
	
		IF ( 
				isset( $_GET['route'] ) &&
				$_GET['route'] == 'API'
			)
			
		{
			$api = new ApiCall () ;
		}
		
		ELSEIF	( 
					isset( $_GET['route'] ) && !empty( $_GET['code'] ) && strlen($_GET['code']) == 250 &&
					$_GET['route'] == 'VALIDATE'
				)
			
		{			
			$validate = new BddTalk () ;
			$validate->validate_code( $_GET['code'] ) ;
		}
		
		ELSEIF	( 
					isset( $_GET['route'] ) && $_GET['route'] == 'VALIDATE'
				)
		{
			echo 'Vous ne passerez pas' ;
			exit() ;
		}
		
		ELSE
		
		{		
			require_once 'include/view_call.php' ;		
		}

?>