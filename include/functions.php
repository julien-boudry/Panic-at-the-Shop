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
Hello ".$pseudo.",
						
You submitted your score ".$score." points via Black Friday Run.
						
To validate your email address and the appearance of the score, thank you to confirm the following link :
						
http://".$_SERVER['SERVER_NAME']."/?route=VALIDATE&code=".$code."
						
						
Wishing you good luck!
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
	
	
		$nbr = 10 ; $v_nbr = $nbr + 1 ;
		
		$action = new BddTalk () ;		
		$data = $action->calc_leaderboard () ;
		$entry = count($data) ;
		
		// Retraitement
		
		$i = 1 ; $i2 = 0 ;
		FOREACH ( $data as $cle => $element )
		{
		
				IF ( $i < ($pagination * $v_nbr) && $i >= ( ($pagination - 1) * $v_nbr) )
				{
					echo '<tr>' ;
					
						echo '<td>'.($cle + 1).'</td>' ;
						echo '<td>'.htmlspecialchars($element[0]).'</td>' ;
						echo '<td>'.$element[1].'</td>' ;
					
					echo '</tr>' ;
					
					$i2++;
				}
			
			$i++ ;
		}
		
	?>
	      </table>
	  
	  <?php IF ($pagination > 1) { ?> <span class="pagination" id="previous" onclick="banane('<?php echo ($pagination - 1); ?>')">Previous</span> <?php } ?>
	  <?php IF ( $entry > ($pagination * $nbr) ) { ?> <span class="pagination" id="next" onclick="banane('<?php echo ($pagination + 1); ?>')">Next</span> <?php } ?>
	  
	<?php
		
		
	}