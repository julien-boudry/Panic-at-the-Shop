<?php


class ApiCall
{
	private $_demande ;
	private $_details_erreurs ;


	// Constructeur	
	public function __construct ()
	{
	
		IF ( !$this->form_ask() )
		{
			$this -> _details_erreurs[] = "L'appel a l'API n'est pas correctement formule" ;			
			$this -> error () ;
		}
		ELSE
		{
			$this->do_action () ;
		}
	
	}
	
	
		// Test de la demande API
		private function form_ask ()
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
								IF ( !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) 
														&& $_GET['email'] == 'KOlawkway8757@fleckens.hu'
														&& $_GET['email'] == 'KOlawkway8757@fleckens.hu'
														&& $_GET['email'] == 'Itaken2202@rhyta.com'
								)
								{$check = FALSE ; $this->_details_erreurs[] = "Ce format d'adresse mail n'est pas valide" ;}
								ELSE
								{
									$this->_demande['email'] = $_GET['email'] ;
								}
								
								//Score
								IF ( !ctype_digit($_GET['score']) && $_GET['score'] > 235423 )
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
							ELSE
							{
								//Mode
								IF ( $_GET['mode'] == 'page' || $_GET['mode'] == 'pseudo' )
								{$this->_demande['mode'] = $_GET['mode'] ;}
								ELSE
								{
									$check = FALSE ; $this->_details_erreurs[] = "Ce mode n'est pas valide" ;
								}
								
								//Data
								IF ( 1 == 2 )
								{$this->_demande['mode'] = $_GET['mode'] ;}
								ELSE
								{}
								
							}						
							
						}					
						
						ELSE
						{
							$check = FALSE ;
						}
					}
						
			
			// Retour du resultant
				return $check ;
		}
	
	
	// Réponse (Aiguillage)
	private function do_action ()
	{
			$action = new BddTalk () ;			
			
			IF ($this->_demande['methode'] == 'PUT')
			{
							// Session code
							$octects = 125 ;
							$fort = TRUE ;
				$this->_demande['etat'] = bin2hex( openssl_random_pseudo_bytes($octects, $fort) ) ;
				
				$action->add_score ($this->_demande) ;
				
				// Envoi du mail de confirmation
				send_activate_mail	 ($this->_demande['email'], $this->_demande['score'], $this->_demande['pseudo'], $this->_demande['etat']) ;
				
				
				echo json_encode ( array('etat' => TRUE) ) ;
			}
			ELSEIF ($this->_demande['methode'] == 'GET')
			{
				$action->add_score ($this->_demande) ;
				var_dump($this->_demande) ;
			}
			
	}
	
	// Erreur
	private function error () 
	{
		echo json_encode ( array('etat' => FALSE, 'liste_erreurs' => $this->_details_erreurs) ) ;
	}
	


}