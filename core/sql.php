<?php

	// [EN] SQL Relay. This profile, sjarkgxb_all, has only 'SELECT' permission
	// [FR] Relais SQL. Le profil sjarkgxb_all n'a que 'SELECT' comme permission

	// Trying to access the database/Tentative d'accès à la base de données
	try {
		$db = "mysql:host="."localhost".";dbname="."sjarkgxb_jarb".";port="."3306".";charset=utf8";
		$connect = new PDO($db, "sjarkgxb_all", "zaR]CqZ50MAVp5p7");
	}
	catch(PDOException $e){
		die("Error : " . $e->getMessage());
	}

	// PDO prepare
	$PDOprep = $connect->prepare("SELECT * FROM `pages` WHERE idPage = ?"); 
	// PDO execute
	$PDOprep->execute([$id]);
	// Fetching/Récupération
	$fetch = $PDOprep->fetchAll();
	$results = $fetch[0];

?>