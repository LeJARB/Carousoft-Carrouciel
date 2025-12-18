<?php

	// [EN] Enhanced syntax based-on Wikipedia's and BBCode's
	// [FR] Syntaxe avancée basée sur celles de Wikipédia et des BBCode
	
	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/syntax.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Final var/Variable finale
	$markup = "";

	// Keep only useful content of the page/Garder seulement le contenu utile de la page
	$header = array($page['title'],$page['subtitle']); if(isset($page['description'])) { array_push($header,$page['description']); }
	$body = $page['content'];

	if(!is_null($body))
	{
		// Split the content for being read line by line/Séparer le contenu pour une lecture ligne par ligne
		$lines = preg_split("/((\r?\n)|(\n?\r))/", $body);
		foreach($lines as $line)
		{
			// Font color & size/Couleur et taille de polices
			if(str_contains($line,"=="))
			{
				preg_match("/==(.*?)\|(.*?)\|(.*?)==/s",$line,$matches);
				$size = $matches[1];
				$color = $matches[2];
				$line = str_replace($matches[0],($isarachne?"<table cellpadding\"0px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"left\">":"")."<font face=\"Arial,Helvetica,sans-serif\" size=\"$size\" color=\"$color\">".$matches[3]."</font>".($isarachne?"</td></tr></table>":""),$line);
			}

			// Paragraph.e
			if(isset($prevline) && !empty($prevline) && empty($line))
			{
				$markup = substr($markup,0,-strlen($prevline)-2);
				$line = "<div align=\"justify\"><font face=\"Arial,Helvetica,sans-serif\" class=\"lineheight\" size=\"4\">".$prevline."</font></div>".($isarachne?"":"<br />");
			}

			// Line break
			if(str_contains($line,">>")) 
			{ 
				if($line != ">>")
				{ $line = str_replace(">>","<br />",$line); }
				else continue;
			}

			// Horizontal row
			if(str_contains($line,"<<")) 
			{ 
				$line = str_replace("<<","<hr noshade=\"noshade\" size=\"1px\"/>",$line);
			}

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
							default : $matches[3][$index] = "&#039;".substr($matches[0][$index],1,-1)."&#039;";
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
					$line = str_replace($matches[0][$index],"<img border=\"0\" src=\"http$https://$host/img/".(($ismajor==5||$isie6)?"png":"gif")."/$value.".(($ismajor==5||$isie6)?"png":"gif")."\" width=\"".$matches[2][$index]."\" height=\"".$matches[3][$index]."\" alt=\"".$matches[4][$index]."\" />",$line);
				}
			}

			// List.e
			if(str_contains($line,"**"))
			{
				if(isset($list))
				{
					if(!empty(substr($line,3)))
					{
						$list .= "\r\n".str_replace(["** ","**"],"<li><p class=\"list\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">",$line)."</font></p></li>";
						continue;
					}
					else
					{
						$line = $list."\r\n</ul>";
						unset($list);
					}
				}
				else
				{
					$list = "<ul>\r\n".str_replace(["** ","**"],"<li><p class=\"list\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">",$line)."</font></p></li>";
					continue;
				}
			}

			// Thumbnails/Vignettes
			if(str_contains($line,"##"))
			{
				$matches = explode("|",str_replace(["## ","##"],"",$line));
				if(isset($thumbnails))
				{
					if(!empty(substr($line,3)))
					{
						if(count($matches) == 1)
						{
							$thumbnails .= "\r\n<".($isie4?"span id=\"thumblistmobile\"":"div align=\"center\"")." class=\"thumblistmobile\">\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<table cellpadding=\"20px\" cellspacing=\"10px\" width=\"100%\"".($isie?" id=\"thumblisttab\"":"")." class=\"thumblisttab\">\r\n<tr><td align=\"center\" bgcolor=\"#242424\" class=\"thumbnails\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td></tr>\r\n</table>".($isie4||$isie5||$isie55?"</div>":"")."</".($isie4?"span":"div").">";
						}
						else
						{
							$thumbnails .= "\r\n<".($isie4?"span id=\"thumblistmobile\"":"div align=\"center\"")." class=\"thumblist\"><center>\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<table cellpadding=\"10px\" cellspacing=\"0px\" width=\"120px\">\r\n<tr><td align=\"center\" bgcolor=\"#242424\" class=\"thumbnails\"><a href=\"http$https://$host/$lang/".$matches[1]."\">".$matches[2]."</a></td></tr></table>".($isie4||$isie5||$isie55?"</div>":"")."\r\n<table cellpadding=\"10px\" cellspacing=\"0px\" width=\"120px\"><tr><td align=\"center\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\"><a href=\"http$https://$host/$lang/".$matches[1]."\">".$matches[0]."</a></font></td></tr>\r\n</table>\r\n</center></".($isie4?"span":"div").">";
						}
						continue;
					}
					else
					{
						$line = $thumbnails."\r\n</td></tr></table></center>";
						unset($thumbnails);
					}
				}
				else
				{
					if(count($matches) == 1)
					{
						$thumbnails = "<center><table cellpadding=\"0px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"center\">\r\n<".($isie4?"span id=\"thumblistmobile\"":"div align=\"center\"")." class=\"thumblistmobile\">\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<table cellpadding=\"20px\" cellspacing=\"10px\" width=\"100%\"".($isie?" id=\"thumblisttab\"":"")." class=\"thumblisttab\">\r\n<tr><td align=\"center\" bgcolor=\"#242424\" class=\"thumbnails\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td></tr>\r\n</table>".($isie4||$isie5||$isie55?"</div>":"")."</".($isie4?"span":"div").">";
					}
					else
					{
						$thumbnails = "<center><table cellpadding=\"0px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"center\">\r\n<".($isie4?"span id=\"thumblistmobile\"":"div align=\"center\"")." class=\"thumblist\"><center>\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<table cellpadding=\"10px\" cellspacing=\"0px\" width=\"120px\">\r\n<tr><td align=\"center\" bgcolor=\"#242424\" class=\"thumbnails\"><a href=\"http$https://$host/$lang/".$matches[1]."\">".$matches[2]."</a></td></tr></table>".($isie4||$isie5||$isie55?"</div>":"")."\r\n<table cellpadding=\"10px\" cellspacing=\"0px\" width=\"120px\"><tr><td align=\"center\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\"><a href=\"http$https://$host/$lang/".$matches[1]."\">".$matches[0]."</a></font></td></tr>\r\n</table>\r\n</center></".($isie4?"span":"div").">";
					}
					continue;
				}
			}

			// Infobox
			if(str_contains($line,"}}"))
			{
				$matches = explode("|",str_replace(["}} ","}}"],"",$line));
				if(isset($infobox))
				{
					if(!empty(substr($line,3)))
					{
						if(count($matches) > 1)
						{
							$infobox = substr($infobox,0,-14)."<tr><td><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td><td><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[1]."</font></td></tr>\r\n</table></div>";
						}
						else
						{
							$infobox = substr($infobox,0,-14)."<tr><td align=\"center\" colspan=\"2\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td></tr>\r\n</table></div>";
						}
						continue;
					}
					else
					{
						$line = $infobox."".($isie4||$isie5||$isie55?"</div>":"")."\r\n</center>";
						unset($infobox);
					}
				}
				else
				{
					if(count($matches) > 1) 
					{
						$infobox = "<center>\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<div class=\"infoboxmobile\" id=\"infobox\">\r\n<table class=\"infobox\" cellpadding=\"5px\" cellspacing=\"0px\" width=\"280px\" bgcolor=\"#242424\">\r\n<tr><td><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td><td><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[1]."</font></td></tr>\r\n</table></div>";
					}
					else
					{
						$infobox = "<center>\r\n".($isie4||$isie5||$isie55?"<div class=\"msie45glow\">":"")."<div class=\"infoboxmobile\" id=\"infobox\">\r\n<table class=\"infobox\" cellpadding=\"5px\" cellspacing=\"0px\" width=\"280px\" bgcolor=\"#242424\">\r\n<tr><td align=\"center\" colspan=\"2\"><font face=\"Arial,Helvetica,sans-serif\" size=\"4\">".$matches[0]."</font></td></tr>\r\n</table></div>";
					}
					continue;
				}
			}

			// Increment.ation
			$prevline = $line;
			$markup .= $line."\r\n";
		}
	}

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

		$entities = array(
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

		if(false) // For accents-incapable browsers/Pour les navigateurs ne supportants pas les accents
		{
			$entities = array(
				"A","A","A","C",
				"E","E","E","E",
				"I","I","Y","O",
				"O","O","OE","U",
				"U","U","a","a",
				"a","c","e","e",
				"e","e","i","i",
				"i","o","o","o",
				"oe","u","u","u"
			);
		}
		
		$s = str_replace($accents,$entities,$s);
		
		return $s;
	}

?>