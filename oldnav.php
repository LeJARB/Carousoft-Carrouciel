<?php

// echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"fr\" lang=\"fr\"><body>";

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

$isie = ((str_contains($agt,"msie")) && !(str_contains($agt,"opera")));
$isie3 = ($isie && ($ismajor < 4)) && !$isw3c;
$isie4 = ($isie && (str_contains($agt,"msie 4")));
$isie5 = ($isie && (str_contains($agt,"msie 5.0")));
$isie55 = ($isie && (str_contains($agt,"msie 5.5")));
$isie6 = ($isie && (str_contains($agt,"msie 6")));
$isie7 = ($isie && (str_contains($agt,"msie 7")));
$isie8 = ($isie && (str_contains($agt,"msie 8")));

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

if ($ismicroweb)
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
}

print_r(array('$agt' => $agt, '$isw3c' => $isw3c, '$isminor' =>$isminor, '$ismajor' => $ismajor, 
'$isnetscape'=>$isnetscape, '$isnetscape2'=>$isnetscape2, '$isnetscape3'=>$isnetscape3, '$isnetscape4'=>$isnetscape4, 
'$isie'=>$isie, '$isie3'=>$isie3, '$isie4'=>$isie4, '$isie5'=>$isie5, '$isie55'=>$isie55, '$isie6'=>$isie6, '$isie7'=>$isie7, '$isie8'=>$isie8, 
'$isopera'=>$isopera, '$isopera2'=>$isopera2, '$isopera3'=>$isopera3, '$isopera4'=>$isopera4, '$isopera5'=>$isopera5, 
'$isopera6'=>$isopera6, '$isopera7'=>$isopera7, '$isopera8'=>$isopera8, '$isopera9'=>$isopera9, '$isopera10_0'=>$isopera10_0, '$isopera10_1'=>$isopera10_1, 
'$isarachne'=>$isarachne, '$isdillo'=>$isdillo, '$istext'=>$istext, '$ismicroweb'=>$ismicroweb, '$iswebboy'=>$iswebboy));

// echo "</body></html>";

?>