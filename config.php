<?php

// HTTP header

	// UTF 8
	header('Content-Type: text/html; charset=utf-8') ;


// DB

	$type_base		= 'mysql' ; // RENSEIGNER LE TYPE DE BDD : MYSQL, MARIADB, PostgreSQL.
	$db_host		= 'localhost' ; // RENSEIGNER L'ADRESSE DU SERVEUR DE BDD
	$db_name		= 'black-friday-run' ; // RENSEIGNER LE NOM DE LA BDD.
	$db_utilisateur	= 'black-friday-run' ; // RENSEIGNER L'IDENTIFIANT DE CONNEXION (UTILISATEUR)
	$db_password 	= 'maH3nqXCcL5GGMZR' ; // RENSEIGNER LE MOT DE PASSE DE LA BDD.


	// SCRIPT DE CONNEXION
	$pdo_options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ) ;

	$base_host = $type_base . ':host=' . $db_host . ';dbname=' . $db_name ;

	try
	{
		$bdd = new PDO($base_host, $db_utilisateur, $db_password, $pdo_options);	
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
		
	}