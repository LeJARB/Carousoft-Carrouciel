<?php

	// [EN] Main SQL Relay.
	// [FR] Relais SQL principal.

	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/connect.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Trying to access the database/Tentative d'accès à la base de données
	// Hidden when pushed to Github/Masqué quand poussé sur 
	try
	{


	}
	catch(PDOException $e)
	{ die("Error : " . $e->getMessage()); }

?>