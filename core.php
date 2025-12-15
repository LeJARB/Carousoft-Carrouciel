<?php

	// [EN] Main process file
	// [FR] Fichier principal de traitement

	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/core.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// [EN] Triyng to obtain client prefered language (only EN or FR for now)
	// [FR] Tentative d'obtention de la langue préférée de l'utilisateur (seulement FR ou EN pour l'instant)
	if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$fr = (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == "fr") ? true : false;
	else
		$fr = (strpos($_SERVER['HTTP_USER_AGENT'], '[fr]')) ? true : false;
		if(!$fr) $fr = (strpos($_SERVER['HTTP_USER_AGENT'], '; fr')) ? true : false;

	// Correct for URL-delacred language/Corretion pour les langues déclarées dans l'URL
	if (isset($_SERVER['REDIRECT_URL']))
		$fr = (substr($_SERVER['REDIRECT_URL'],1,2) == "fr") ? true : false;
	$lang = ($fr) ? "fr" : "en";

	// Refresh root with correct language/Actualiser la racine avec la bonne langue 
	$https = (isset($_SERVER['HTTPS']) == true) ? "s" : "";
	$host = $_SERVER['HTTP_HOST'];
	if(!isset($url)) 
	{ 
		$url = ($fr) ? "Accueil" : "Home";
		header("Location: http$https://$host/$lang/$url");
		exit;
	}
	else if(substr($_SERVER['REDIRECT_URL'],1,2) == substr($_SERVER['REDIRECT_URL'],1))
	{
		switch(substr($_SERVER['REDIRECT_URL'],1))
		{
			case "en": $lang = "en"; break;
			case "fr": $lang = "fr"; break;
			default: $lang = "ukn"; break;
		}
		if($lang != "ukn")
		{
			$url = ($lang == "fr") ? "Accueil" : "Home";
			header("Location: http$https://$host/$lang/$url");
			exit;
		}
	}

	// Call to/Appel à oldnav.php & page.php & syntax.php & render.php
	require('oldnav.php');
	require('page.php');
	require('syntax.php');
	require('render.php');

?>