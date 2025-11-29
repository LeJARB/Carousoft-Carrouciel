<?php

	// [EN] SQL Relay.
	// [FR] Relais SQL.
	
	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/sql.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Trying to access the database/Tentative d'accès à la base de données
	// Hidden when pushed to Github/Masqué quand poussé sur 
	try
	{
		

	}
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

	// PDO prepare
	$PDOprep = $connect->prepare("SELECT * FROM `pages` WHERE name = BINARY ? AND lang = ?"); 
	
	// PDO execute
	try 
	{ $PDOprep->execute([$url,$lang]); }
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

	// Fetching/Récupération
	$fetch = $PDOprep->fetchAll();

	// Error 404 if the fetch returns null/Erreur 404 si la requête retourne un résultat null
	if(!isset($fetch[0])) { header($_SERVER['SERVER_PROTOCOL']." 404"); exit("404 Not Found"); }

	// Save result/Sauvegarder le résultat
	$results = $fetch[0];

?>