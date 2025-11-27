<?php

	// [EN] Main process file
	// [FR] Fichier principal de traitement

	// [EN] Triyng to obtain client prefered language (only EN or FR for now)
	// [FR] Tentative d'obtention de la langue préférée de l'utilisateur (seulement FR ou EN pour l'instant)
	if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$fr = (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == "fr") ? true : false;
	else
		$fr = (strpos($_SERVER['HTTP_USER_AGENT'], '[fr]')) ? true : false;
		if(!$fr) $fr = (strpos($_SERVER['HTTP_USER_AGENT'], '; fr')) ? true : false;

	// Correct for URL-delacred language/Corretion pour les langues déclarées dans l'URL
	if (isset($_GET['lang'])) 
		$fr = ($_GET['lang'] == 'fr') ? true : false;
	if (isset($_SERVER['REDIRECT_QUERY_STRING']))
		$fr = ($_SERVER['REDIRECT_QUERY_STRING'] == "lang=fr") ? true : false;
	$lang = ($fr) ? "fr" : "en";

	// Create an $urn for root page/Création d'une $urn pour la page racine
	if(!isset($urn)) $urn = ($fr) ? "Accueil" : "Home";

	// Call to/Appel à sql.php & syntax.php
	require('sql.php');
	require('syntax.php');

?>