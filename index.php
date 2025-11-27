<?php

	// Obtain URL/Obtention de l'URL
	if(isset($_SERVER['REDIRECT_URL'])) $urn = substr($_SERVER['REDIRECT_URL'],1);

	// Call to/Appel à core.php
	require('.\core\core.php');

?>