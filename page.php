<?php

	// [EN] SQL Relay for page content.
	// [FR] Relais SQL pour le contenu de page.

	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/page.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Trying to access the database/Tentative d'accès à la base de données
	require('connect.php');

	// PDO prepare
	$PDOprepPage = $connect->prepare("SELECT * FROM `pages` WHERE name = BINARY ? AND lang = ?"); 
	
	// PDO execute
	try 
	{ $PDOprepPage->execute([$url,$lang]); }
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

	// Fetching/Récupération
	$fetchPage = $PDOprepPage->fetchAll();

	// Error 404 if the fetch returns null/Erreur 404 si la requête retourne un résultat null
	if(!isset($fetchPage[0])) { header($_SERVER['SERVER_PROTOCOL']." 404"); exit("404 Not Found"); }

	// Save result/Sauvegarder le résultat
	$page = $fetchPage[0];

?>