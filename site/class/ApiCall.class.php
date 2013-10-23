<?php


class ApiCall
{
	private $_demande ;
	private $_details_erreurs ;


	// Constructeur	
	public function __construct ()
	{
	
		IF ( !$this->test_ask() )
		{
			$this->_details_erreurs[] = "L'appel a l'API n'est pas correctement formule" ;
			
			$this -> error () ;
		}
	
	}
	
	
		// Test de la demande API
		private function test_ask ()
		{
			$check = TRUE ;
			
			// Tests
			
				//Type de demande
					IF ( !isset ($_GET['demande'])	)
					{
						$check = FALSE ;
					}
					ELSE
					{
						// Cas d'une soummission de score
						IF ( $_GET['demande'] == 'PUT' )
						{
							$this->_demande['methode'] = 'PUT' ;
							
							// Vérification des informations associées
							IF ( !isset ($_GET['pseudo']) || !isset ($_GET['email']) || !isset ($_GET['score']) )
							{
								$check = FALSE ;
							}
							ELSE
							{
								//Pseudo
								IF ( strlen($_GET['pseudo']) > 12 )
								{$check = FALSE ; $this->_details_erreurs[] = "Le pseudo est trop long" ;}
								ELSEIF ( /*pseudo_exist($_GET['pseudo'], $_GET['email']) === TRUE*/ 1 == 2 )
								{$check = FALSE ; $this->_details_erreurs[] = "Le pseudo est déjà pris" ;}
								ELSE
								{
									$this->_demande['pseudo'] = $_GET['pseudo'] ;
								}
								
								//Email
								IF ( !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) )
								{$check = FALSE ; $this->_details_erreurs[] = "Ce format d'adresse mail n'est pas valide" ;}
								ELSE
								{
									$this->_demande['email'] = $_GET['email'] ;
								}
								
								//Score
								IF ( !ctype_digit($_GET['score']) )
								{$check = FALSE ; $this->_details_erreurs[] = "Tricheur !" ;}
								ELSE
								{
									$this->_demande['score'] = $_GET['score'] ;
								}
							}

							
						}
						// Cas d'une demande de tableau
						ELSEIF ( $_GET['demande'] == 'GET' )
						{
							$this->_demande['methode'] = 'GET' ;
							
							// Vérification des informations associées
							IF ( !isset ($_GET['mode']) || !isset ($_GET['data']) )
							{
								$check = FALSE ;
							}
						}
						
						
						
						ELSE
						{
							$check = FALSE ;
						}
					}
					
				// Cas d'une demande PUT	
						
			
			// Retour du resultant
				return $check ;
		}
	
	
	// Réponse (Aiguillage)
	private function reponse ()
	{
	
	
	}
	
	// Erreur
	private function error () 
	{
		echo json_encode ( array('etat' => FALSE, 'liste_erreurs' => $this->_details_erreurs) ) ;
	}
	


}