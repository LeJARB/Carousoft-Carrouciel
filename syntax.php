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
				if(isset($prevline) && !empty($prevline) && empty($line))
				{
					$markup = substr($markup,0,-strlen($prevline)-2);
					$line = "<p>".$prevline."</p>";
				}

				// Line break
				if(str_contains($line,">>")) { $line = str_replace(">>","<br />",$line); }

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
								default : $matches[3][$index] = "<font color=\"red\">&#039;".substr($matches[0][$index],1,-1)."&#039;</font>";
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

				// Images
				if(str_contains($line,"::"))
				{
					preg_match_all("/::(.*?)\|(.*?)\|(.*?)\|(.*?)::/s",$line,$matches);
					// Name, Width, Height, Alt
					foreach($matches[1] as $index => $value)
					{
						$line = str_replace($matches[0][$index],"<img border=\"0\" src=\"http$https://$host/images/$value\" width=\"".$matches[2][$index]."\" height=\"".$matches[3][$index]."\" alt=\"".$matches[4][$index]."\" />",$line);
					}
				}

				// Increment.ation
				$prevline = $line;
				$markup .= $line."\r\n";
			}
		}
	}

	// Show the formatted content/Afficher le contenu mis en forme
	echo accents(substr($markup,0,-2));

	// [EN] Convert accented characters to HTML entities
	// [FR] Conversion des caractères accentués en entités HTML
	function accents(string $s) : string
	{
		$accents = array(
			"À","Â","Ä","Ç",
			"È","É","Ê","Ë",
			"Ì","Î","Ý","Ò",
			"Ô","Ö","Œ","Ù",
			"Û","Ü","à","â",
			"ä","ç","è","é",
			"ê","ë","ì","î",
			"ï","ò","ô","ö",
			"œ","ù","û","ü"
		);

		$entites = array(
			"&#192;","&#194;","&#196;","&#199;",
			"&#200;","&#201;","&#202;","&#203;",
			"&#204;","&#206;","&#207;","&#210;",
			"&#212;","&#214;","&#338;","&#217;",
			"&#219;","&#220;","&#224;","&#226;",
			"&#228;","&#231;","&#232;","&#233;",
			"&#234;","&#235;","&#236;","&#238;",
			"&#239;","&#242;","&#244;","&#246;",
			"&#339;","&#249;","&#251;","&#252;"
		);
		
		$s = str_replace($accents,$entites,$s);
		
		return $s;
	}

?>