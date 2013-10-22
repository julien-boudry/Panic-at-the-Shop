<?php

	// Config
	
		require_once 'config.php' ;
	
	// Fonctions && Class
	
		require_once 'include/functions.php' ;
		
		// Chargement automatique des classes
		function chargerClasse($classe)
		{
		  require_once 'class'.DIRECTORY_SEPARATOR. $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
		} 
		
		spl_autoload_register('chargerClasse') ; // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

	
	// Aiguillage API vs WEB
	
		IF ( 
				isset( $_GET['route'] ) &&
				$_GET['route'] == 'API'
			)
			
		{
			require_once 'include/api_call.php' ;
		}
		
		ELSE
		
		{		
			require_once 'include/view_call.php' ;		
		}

?>