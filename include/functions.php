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
	
// Envoi du mail de confirmation
	function send_activate_mail	 ($to, $score, $pseudo, $code)
	{
		$subject = "Validez votre score Black Friday Run";
		
		$message =	"
Bonjour ".$pseudo.",
						
Vous avez soumis votre score de ".$score." points via Black Friday Run.
						
Pour valider votre adresse mail et l'apparition du score, merci de valider le lien suivant :
						
http://".$_SERVER['SERVER_NAME']."/?route=VALIDATE&code=".$code."
						
						
En vous souhaitant bonne chance !
					";
		
		
		$from = "blackfridayrun@artisanat-furieux.net";
		$headers = "From:" . $from;
		
		mail($to,$subject,$message,$headers);
	}
	
	
	function jsLibrairies($nom_librairie, $version)
	{
		IF($nom_librairie == 'jquery')
		{
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js"></script>' ;
		}
		
		IF($nom_librairie == 'jquery-ui')
		{
			echo '<script src="//ajax.googleapis.com/ajax/libs/jqueryui/'.$version.'/jquery-ui.min.js"></script>' ;
		}
		
	}

	
// Fabrique un tableau des scores
	function the_leaderboard ($pagination = 1, $looking = NULL)
	{
	?>
	      <table border="0" id="table_score">

          <tr>
            <th>Rank</th>
			<th>Pseudo</th>
			<th>Score</th>
          </tr>
	<?php
	
	
		$nbr = 20 ; $v_nbr = $nbr + 1 ;
		
		$action = new BddTalk () ;		
		$data = $action->calc_leaderboard () ;
		
		// Retraitement
		
		$i = 1 ;
		FOREACH ( $data as $cle => $element )
		{
		
				IF ( $i < ($pagination * $v_nbr) && $i > ( ($pagination - 1) * $v_nbr) )
				{
				echo '<tr>' ;
				
					echo '<td>'.($cle + 1).'</td>' ;
					echo '<td>'.$element[0].'</td>' ;
					echo '<td>'.$element[1].'</td>' ;
				
				echo '</tr>' ;
				}
			
			$i++ ;
		}
		
	?>
	      </table>
	  
	  <span class="pagination" id="previous" onclick="banane('<?php echo ($pagination - 1); ?>')">Previous</span> <span class="pagination" id="next" onclick="banane('<?php echo ($pagination + 1); ?>')">Next</span>
	  
	<?php
		
		
	}