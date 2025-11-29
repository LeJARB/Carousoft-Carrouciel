<?php

	// [EN] Enhanced syntax based-on Wikipedia's
	// [FR] Syntaxe avancée basée sur celle de Wikipédia
	
	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/syntax.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }


	// Final var/Variable finale
	$markup = "";

	// Keep only useful content of the page/Garder seulement le contenu utile de la page
	unset($page['lang'],$page['name'],$page[2],$page['title'],$page['subtitle'],$page['description'],$page['content']);

	// $content = $page[5];
	foreach($page as $content)
	{	
		if(!is_null($content))
		{
			// Split the content for being read line by line/Séparer le contenu pour une lecture ligne par ligne
			$lines = preg_split("/((\r?\n)|(\n?\r))/", $content);
			foreach($lines as $line)
			{
				// Titles/Titres
				if(str_contains($line,"=="))
				{
					preg_match("/==(.*?)\|(.*?)==/s",$line,$matches);
					$size = $matches[1];
					$line = "<h$size>".$matches[2]."</h$size>";
				}

				// Paragraph.e
				if(isset($prevline) && empty($line))
				{
					$markup = substr($markup,0,-strlen($prevline)-2);
					$line = "<p>".$prevline."</p>";
				}

				// Line break
				if(str_contains($line,"<>")) { $line = str_replace("<>","<br/>",$line); }

				// Font formatting/Mise en forme de la police
				if(str_contains($line,"''"))
				{
					preg_match_all("/''(.*?)\|(.*?)''/s",$line,$matches); 
					foreach($matches[1] as $index => $value)
					{
						$matches[3][$index] = $matches[2][$index];
						foreach(str_split($value) as $char)
						{
							switch($char)
							{
								case "B": $matches[3][$index] = "<b>".$matches[3][$index]."</b>"; break;
								case "I": $matches[3][$index] = "<i>".$matches[3][$index]."</i>"; break;
								case "U": $matches[3][$index] = "<u>".$matches[3][$index]."</u>"; break;
								case "S": $matches[3][$index] = "<s>".$matches[3][$index]."</s>"; break;
								case "E": $matches[3][$index] = "<sup>".$matches[3][$index]."</sup>"; break;
								case "X": $matches[3][$index] = "<sub>".$matches[3][$index]."</sub>"; break;
								default : $matches[3][$index] = "<font color=\"red\">&apos;".substr($matches[0][$index],1,-1)."&apos;</font>";
							}
						}
					}
					$line = str_replace($matches[0],$matches[3],$line);
				}

				// Hyperlinks/Hyperliens
				if(str_contains($line,"[["))
				{
					preg_match_all("/\[\[(.*?)\|(.*?)\]\]/s",$line,$matches);
					foreach($matches[1] as $index => $value)
					{
						$matches[3][$index] = "<a href=\"http$https://$host/$lang/$value\">".$matches[2][$index]."</a>";
						if(str_contains($value,"://")) $matches[3][$index] = "<a href=\"$value\">".$matches[2][$index]."</a>";
					}
					$line = str_replace($matches[0],$matches[3],$line);
				}

				// Increment.ation
				$prevline = $line;
				$markup .= $line."\r\n";
			}
		}
	}

	// Show the formatted content/Afficher le contenu mis en forme
	echo substr($markup,0,-2);

?>