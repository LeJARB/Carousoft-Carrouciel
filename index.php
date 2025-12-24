<?php

	// Obtain URL/Obtention de l'URL
	if(isset($_SERVER['REDIRECT_URL']))
		$_SERVER['REDIRECT_URL'] = str_replace(" ",".",$_SERVER['REDIRECT_URL']);
		$url = substr($_SERVER['REDIRECT_URL'],4);

	// Call to/Appel à core.php
	require('core.php');

?>