<?php

	// [EN] SQL Relay. This profile, sjarkgxb_all, has only 'SELECT' permission
	// [FR] Relais SQL. Le profil sjarkgxb_all n'a que 'SELECT' comme permission

	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/sql.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Trying to access the database/Tentative d'accès à la base de données
	try
	{
		$db = "mysql:host="."localhost".";dbname="."sjarkgxb_jarb".";port="."3306".";charset=utf8";
		$connect = new PDO($db, "sjarkgxb_all", "zaR]CqZ50MAVp5p7");
	}
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

	// PDO prepare
	$PDOprep = $connect->prepare("SELECT * FROM `pages` WHERE name = BINARY ?"); 
	
	// PDO execute
	try 
	{ $PDOprep->execute([$url]); }
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

	// Fetching/Récupération
	$fetch = $PDOprep->fetchAll();

	// Error 404 if the fetch returns null/Erreur 404 si la requête retourne un résultat null
	if(!isset($fetch[0])) { header($_SERVER['SERVER_PROTOCOL']." 404"); exit("404 Not Found"); }

	// Save result/Sauvegarder le résultat
	$results = $fetch[0];

?>