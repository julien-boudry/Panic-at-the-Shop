<?php

class BddTalk
{

	// Ajout d'un score
	public function add_score ($demande)
	{
		$sql =
		'
			INSERT INTO `scores` ( `PSEUDO`, `EMAIL`, `SCORE`, `IP`, `ETAT` )
			VALUES ( :pseudo, :email, :score, :ip, :etat ) ;
		' ;
		
		$param = array	(
							'pseudo'	=> $demande['pseudo'],
							'email'		=> $demande['email'],
							'score'		=> $demande['score'],
							'ip'		=> $_SERVER["REMOTE_ADDR"],
							'etat'		=> $demande['etat']
						) ;

		requete ($sql, 'prepare', $param) ;
	}
	
	public function validate_code ($code)
	{
	
		$sql =	"
					UPDATE `scores`
					SET `ETAT` = 'OK'
					WHERE `ETAT` = :code ;
				" ;
					
		$param = array	(
							'code'	=> $code
						) ;
						
		requete ($sql, 'prepare', $param) ;		
	
	}
	
}