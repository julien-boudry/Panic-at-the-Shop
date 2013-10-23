<?php

	function chargerClasse($classe)
	{
	  require_once 'class'.DIRECTORY_SEPARATOR. $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
	} 

// Requêtes SQL
	function requete ($query, $type = 'do', $param = NULL)
	{		
		global $bdd ;
		
		IF ($type == 'prepare' && !is_null($param))
		{
			$requete = $bdd->prepare($query) ;
			
			IF (!is_null($param))
				{
				$requete->execute($param) ;
				}
			ELSEIF (is_null($param))
				{
				$requete->execute() ;
				}
		}
		ELSEIF ($type == 'do')
		{
			$requete = $bdd->query($query) ;
		}
		
		return $requete ;
	}