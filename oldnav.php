<?php

	// [EN] User-Agent parser for detecting old web browsers
	// [FR] Analyseur de User-Agent pour détécter les anciens navigateurs

	// File Protection by 403 Forbidden
	if($_SERVER['SCRIPT_NAME'] == "/oldnav.php") { header($_SERVER['SERVER_PROTOCOL']." 403"); exit("403 Forbidden"); }

	$agt = strtolower($_SERVER["HTTP_USER_AGENT"]);

	$isw3c = str_contains($agt,"w3c");

	$isminor = str_contains($agt,"mozilla") ? floatval(explode("/",explode(" ",$agt)[0])[1]) : "";
	$ismajor = str_contains($agt,"mozilla") ? intval(explode(".",$isminor)[0]) : "";

	$isnetscape = ((str_contains($agt,"mozilla")) && !(str_contains($agt,"spoofer"))
				&& !(str_contains($agt,"compatible")) && !(str_contains($agt,"opera"))
				&& !(str_contains($agt,"khtml")) && !(str_contains($agt,"goanna"))
				&& !(str_contains($agt,"firefox")) && !(str_contains($agt,"gecko")));
	$isnetscape2 = ($isnetscape && ($ismajor == 2));
	$isnetscape3 = ($isnetscape && ($ismajor == 3));
	$isnetscape4 = ($isnetscape && ($ismajor == 4));

	$isgecko = str_contains($agt,"gecko") && !str_contains($agt,"like");
	$isphoenix = str_contains($agt,"phoenix");
	$isfirebird = str_contains($agt,"firebird");
	$isfirefox = str_contains($agt,"firefox");
	$isfirefox0 = $isphoenix || $isfirebird || ($isfirefox && (str_contains($agt,"firefox/0.")));
	$isfirefox1 = ($isfirefox && (str_contains($agt,"firefox/1.0")));
	$isfirefox1_5 = ($isfirefox && (str_contains($agt,"firefox/1.5")));
	$isfirefox2 = ($isfirefox && (str_contains($agt,"firefox/2.0")));
	$isfirefox3 = ($isfirefox && (str_contains($agt,"firefox/3.0")));
	$isfirefox3_5 = ($isfirefox && (str_contains($agt,"firefox/3.5")));
	$isfirefox3_6 = ($isfirefox && (str_contains($agt,"firefox/3.6")));

	$isie = ((str_contains($agt,"msie")) && !(str_contains($agt,"opera")));
	$isie3 = ($isie && ($ismajor < 4)) && !$isw3c;
	$isie4 = ($isie && (str_contains($agt,"msie 4")));
	$isie5 = ($isie && (str_contains($agt,"msie 5.0")));
	$isie5_5 = ($isie && (str_contains($agt,"msie 5.5")));
	$isie6 = ($isie && (str_contains($agt,"msie 6")));
	$isie7 = ($isie && (str_contains($agt,"msie 7")));
	$isie8 = ($isie && (str_contains($agt,"msie 8")));
	$isie9 = ($isie && (str_contains($agt,"msie 9")));

	$isopera = (str_contains($agt,"opera") || str_contains($agt,"opr"));
	$isopera2 = (str_contains($agt,"opera 2") || str_contains($agt,"opera/2"));
	$isopera3 = (str_contains($agt,"opera 3") || str_contains($agt,"opera/3"));
	$isopera4 = (str_contains($agt,"opera 4") || str_contains($agt,"opera/4"));
	$isopera5 = (str_contains($agt,"opera 5") || str_contains($agt,"opera/5"));
	$isopera6 = (str_contains($agt,"opera 6") || str_contains($agt,"opera/6"));
	$isopera7 = (str_contains($agt,"opera 7") || str_contains($agt,"opera/7"));
	$isopera8 = (str_contains($agt,"opera 8") || str_contains($agt,"opera/8"));
	$isopera9 = (str_contains($agt,"opera 9") || str_contains($agt,"opera/9")) && !str_contains($agt,"version/");
	$isopera10_0 = str_contains($agt,"opera/9.80")?str_contains($agt,"version/10.0"):(str_contains($agt,"opera 10.0") || str_contains($agt,"opera/10.0"));
	$isopera10_1 = str_contains($agt,"opera/9.80")?str_contains($agt,"version/10.1"):(str_contains($agt,"opera 10.1") || str_contains($agt,"opera/10.1"));

	$isarachne = str_contains($agt,"xchaos");
	$ismicroweb = str_contains($agt,"microweb");
	$isdillo = (str_contains($agt,"dillo") || str_contains($agt,"dillo") || $agt == "links");
	$istext = str_contains($agt,"lynx") || (str_contains($agt,"links") && $agt != "links") || str_contains($agt,"text");
	$iswebboy = str_contains($agt,"webboy");
	$ismdx = str_contains($agt,"mdx");

	/* if ($ismicroweb)
	{
		$couleurs["bgcolor"] = $couleurs["nom"]=="sombre"?"555555":"aaaaaa";
		$couleurs["iconecadre"] = $couleurs["nom"]=="sombre"?"555555":"aaaaaa";
		$couleurs["listecadre"] = $couleurs["nom"]=="sombre"?"555555":"aaaaaa";
		$couleurs["popup"] = $couleurs["nom"]=="sombre"?"555555":"aaaaaa";
		$couleurs["text"] = $couleurs["nom"]=="sombre"?"ffffff":"000000";
		$couleurs["link"] = $couleurs["nom"]=="sombre"?"55ffff":"00aaaa";
		$couleurs["textlogo"] = $couleurs["nom"]=="sombre"?"ff5555":"aa0000";
		$couleurs["fausse"] = $couleurs["nom"]=="sombre"?"ff5555":"aa0000";
		$couleurs["sommaire"] = $couleurs["nom"]=="sombre"?"ffff00":"aa5500";
		$couleurs["listextesection"] = $couleurs["nom"]=="sombre"?"ffff00":"aa5500";
		$couleurs["pied"] = $couleurs["nom"]=="sombre"?"ffff00":"aa5500";
		$couleurs["peutetre"] = $couleurs["nom"]=="sombre"?"ffff00":"aa5500";
		$couleurs["soustitretexte"] = $couleurs["nom"]=="sombre"?"55ff55":"00aa00";
		$couleurs["iconenom"] = $couleurs["nom"]=="sombre"?"55ff55":"00aa00";
		$couleurs["listenom"] = $couleurs["nom"]=="sombre"?"55ff55":"00aa00";
		$couleurs["listextenom"] = $couleurs["nom"]=="sombre"?"55ff55":"00aa00";
		$couleurs["disponible"] = $couleurs["nom"]=="sombre"?"55ff55":"00aa00";
	} */

?>