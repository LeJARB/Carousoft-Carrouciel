<?php

	// [EN] Enhanced syntax based-on Wikipedia's
	// [FR] Syntaxe avancée basée sur celle de Wikipédia

	$markup = "";
	$content = $results[5];
	$lines = preg_split("/((\r?\n)|(\n?\r))/", $content);
	foreach($lines as $line)
	{
		// Titles/Titres
		if(str_contains($line,"="))
		{
			switch(substr_count($line,"=")/2)
			{
				case 1: $line = str_replace(["= "," ="],["<h1>","</h1>"],$line); break;
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

		// Increment.ation
		$prevline = $line;
		$markup .= $line."\r\n";
	}
	echo substr($markup,0,-2);

?>