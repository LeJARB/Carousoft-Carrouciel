<?php

	// [EN] Enhanced syntax based-on Wikipedia's
	// [FR] Syntaxe avancée basée sur celle de Wikipédia
	
	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/syntax.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }


	// Final var/Variable finale
	$markup = "";

	// Keep only the content of the page/Garder seulement le contenu de la page
	$content = $results['content'];

	// Split the content for being read line by line/Séparer le contenu pour une lecture ligne par ligne
	$lines = preg_split("/((\r?\n)|(\n?\r))/", $content);
	foreach($lines as $line)
	{
		// Titles/Titres
		if(str_contains($line,"=="))
		{
			switch(substr_count($line,"=")/2)
			{
				case 2: $line = str_replace(["== "," =="],["<h2>","</h2>"],$line); break;
				case 3: $line = str_replace(["=== "," ==="],["<h3>","</h3>"],$line); break;
				case 4: $line = str_replace(["==== "," ===="],["<h4>","</h4>"],$line); break;
				case 5: $line = str_replace(["===== "," ====="],["<h5>","</h5>"],$line); break;
				case 6: $line = str_replace(["====== "," ======"],["<h6>","</h6>"],$line); break;
			}
		}

		// Paragraph.e
		if(isset($prevline) && empty($line))
		{
			$markup = substr($markup,0,-strlen($prevline)-2);
			$line = "<p>".$prevline."</p>";
		}

		// Correct <br> for XHTML 1.0 Transitionnal
		if(str_contains($line,"<br>")) { $line = str_replace("<br>","<br/>",$line); }

		// Font formatting/Mise en forme de la police
		if(str_contains($line,"{{"))
		{
			preg_match_all("/{{(.*?)\|(.*?)}}/s",$line,$matches);
			foreach($matches[1] as $clé => $valeur)
			{
				$matches[3][$clé] = $matches[2][$clé];
				if(str_contains($valeur,"B")) $matches[3][$clé] = "<b>".$matches[3][$clé]."</b>";
				if(str_contains($valeur,"I")) $matches[3][$clé] = "<i>".$matches[3][$clé]."</i>";
				if(str_contains($valeur,"U")) $matches[3][$clé] = "<u>".$matches[3][$clé]."</u>";
				if(str_contains($valeur,"S")) $matches[3][$clé] = "<s>".$matches[3][$clé]."</s>";
				if(str_contains($valeur,"E")) $matches[3][$clé] = "<sup>".$matches[3][$clé]."</sup>";
				if(str_contains($valeur,"X")) $matches[3][$clé] = "<sub>".$matches[3][$clé]."</sub>";
			}
			$line = str_replace($matches[0],$matches[3],$line);
		}

		// Increment.ation
		$prevline = $line;
		$markup .= $line."\r\n";
	}

	// Show the formatted content/Afficher le contenu mis en forme
	echo substr($markup,0,-2);

?>