<?php

	// [EN] HTML rendering script
	// [FR] Script de rendu HTML
	
	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/render.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	// Header/Entête
	$render = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"$lang\" lang=\"$lang\" class=\"".($isie6||$isie7||$isie8||$isie9?"msie559":"")."gradient\"".(($isw3c)?"":" prefix=\"og: https://ogp.me/ns#\"").">
<head>
	<title>".$header[0]." - ".(($lang == "fr") ? "Carrouciel" : "Carousoft")."</title>".(($isw3c)?"":"
	<meta property=\"og:title\" content=\"".$header[0]." - ".(($lang == "fr") ? "Carrouciel" : "Carousoft")."\" />")."
	<meta name=\"twitter:title\" content=\"".$header[0]." - ".(($lang == "fr") ? "Carrouciel" : "Carousoft")."\" />
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<meta http-equiv=\"Content-Language\" content=\"$lang\" />
	<meta name=\"author\" content=\"Projets Signé JARB\" />
	<meta name=\"robots\" content=\"index, follow\" />
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1\" />
	<link rel=\"icon\" type=\"image/x-icon\" href=\"http$https://$host/img/favicon.ico\" />".($isie3?"
	<link href=\"http$https://$host/classforie3.css\" rel=\"stylesheet\" type=\"text/css\" />":"
	<link href=\"http$https://$host/class.css\" rel=\"stylesheet\" type=\"text/css\" />").($isie6||$isie7||$isie8||$isie9?"
	<link href=\"http$https://$host/behavior.css\" rel=\"stylesheet\" type=\"text/css\" />":"").(($isie5||$isie5_5||$isie6||$isie7)?"
	<!-- <link href=\"http$https://$host/inlineie567.css\" rel=\"stylesheet\" type=\"text/css\" /> -->":"")."
	<!--<meta name=\"theme-color\" content=\"#242424\" />-->
	<meta name=\"twitter:site\" content=\"@le_jarb\" />
	<meta name=\"twitter:creator\" content=\"@le_jarb\" />
	<meta name=\"twitter:card\" content=\"summary_large_image\" />
	<meta name=\"twitter:image\" content=\"http$https://$host/img/jarb_x3.gif\" />".(($isw3c)?"":"
	<meta property=\"og:type\" content=\"website\" />
	<meta property=\"og:url\" content=\"http$https://$host/$lang\" />
	<meta property=\"og:site_name\" content=\"".(($lang == "fr") ? "Carrouciel" : "Carousoft")."\" />
	<meta property=\"og:image\" content=\"http$https://$host/img/jarb_x3.gif\" />
	<meta property=\"og:locale\" content=\"".(($lang == "fr") ? "fr_FR" : "en_US")."\" />");

	// Description if exists/si existe
	$render .= (isset($header[2])) ? "
	<meta name=\"description\" content=\"".$header[2]."\" />".(($isw3c)?"":"
	<meta property=\"og:description\" content=\"".$header[2]."\" />")."
	<meta name=\"twitter:description\" content=\"".$header[2]."\" />\r\n" : "";

	$render .= "</head>
	<body ".($ismajor==5&&!$isfirefox0&&!$isfirefox1&&!$isfirefox1_5&&!$isfirefox2&&!$isfirefox3&&!$isfirefox3_5?"":"bgcolor=\"#242424\" ")."text=\"#DADADA\" link=\"#1E90FF\" vlink=\"#1E90FF\"".($isie5_5?" class=\"msie559gradient\"":"").">
	<center>
	<table id=\"header\" cellpadding=\"0px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"center\">
		<center>
			<table cellpadding=\"0px\" cellspacing=\"0px\"><tr><td align=\"right\">
				<img src=\"http$https://$host/img/".(($ismajor==5||$isie6||$isdillo||$ismdx)?"png":"gif")."/".(($lang == "fr") ? "Carrouciel" : "Carousoft").($isdillo||$ismdx?"_45px":"").".".(($ismajor==5||$isie6||$isdillo||$ismdx)?"png":"gif")."\" alt=\"".(($lang == "fr") ? "Carrouciel" : "Carousoft")."\" border=\"0\" width=\"".(($lang == "fr") ? "276" : "262")."px\" height=\"45px\" /><br />
				<font face=\"Arial,Helvetica,sans-serif\" size=\"1\" color=\"#FFFFFF\"><b><i>".(($lang == "fr") ? "Un Projet Signé JARB" : "A Signé JARB Project")."</i></b></font>
			</td></tr></table>
		    <font face=\"Arial,Helvetica,sans-serif\"><b><font color=\"#DAA520\">".(($url=="Accueil"||$url=="Home")?"":"<a href=\"http$https://$host/$lang/").(($lang == "fr")?"Accueil":"Home").(($url=="Accueil"||$url=="Home")?"":"\">".(($lang == "fr")?"Retour à l'accueil":"Return to homepage")).(($url=="Accueil"||$url=="Home")?"":"</a>")."</font></b></font>
		</center>
	</td></tr></table><br />
	".($isie4||$isie5?"<div class=\"msie45glow\">":"")."<table class=\"subtitle".($isie5_5?" msie55glow":"")."\" cellpadding=\"10px\" cellspacing=\"0px\" bgcolor=\"#000000\"><tr><td align=\"center\">
		<center><font face=\"Arial,Helvetica,sans-serif\" size=\"5\" color=\"#FF4500\"><b>".$header[1]."</b></font></center>
	</td></tr></table>".($isie4||$isie5?"</div>":"")."<br />
	".($isie4||$isie5?"<div class=\"msie45glow\">":"")."<table class=\"content".($isie5_5?" msie55glow":"")."\" id=\"content\" cellpadding=\"0px\" cellspacing=\"0px\" bgcolor=\"#000000\" width=\"100%\"><tr><td>
		<table cellpadding=\"10px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"left\">";
	
	// Body/Corps
	$render .= $markup;

	// End/Fin
	$render .= "\t\t</td></tr></table>
	</td></tr></table>".($isie4||$isie5?"</div>":"")."<br />
	<table id=\"footer\" cellpadding=\"0px\" cellspacing=\"0px\" width=\"100%\"><tr><td align=\"center\">
		<center>
		    <font face=\"Arial,Helvetica,sans-serif\" color=\"#32CD32\"><b>".(($lang == "fr") ? "Ce site est optimisé pour certains anciens navigateurs et est conforme aux normes suivantes" : "This website is optimized for some old browsers and complies with the following standards")."</b></font><br /><br />
		    <img src=\"http$https://$host/img/gif/valid-xhtml10.gif\" border=\"0\" alt=\"".(($lang == "fr") ? "XHTML 1.0 Transitional Validé" : "Valid XTHML Transitional")."\" width=\"88px\" height=\"31px\" /> <img src=\"http$https://$host/img/gif/valid-css.gif\" border=\"0\" alt=\"".(($lang == "fr") ? "CSS Validé" : "Valid CSS")."\" width=\"88px\" height=\"31px\" />
		</center>
	</td></tr></table>
	</center>".($isfirefox0||$isfirefox1||$isfirefox1_5||$isfirefox2?"":"
	<script type=\"text/javascript\" src=\"http$https://$host/script.js\"></script>")."
	</body>
</html>";

	// Show/Afficher
	echo accents($render);

?>