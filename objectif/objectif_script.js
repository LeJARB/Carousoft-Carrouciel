var padding = 20;
if (navigator.userAgent.indexOf("MSIE 4") != "-1" || navigator.userAgent.indexOf("MSIE 5") != "-1")
{ padding = 0; }
largeur_ecran(padding);
window.onorientationchange = function() { largeur_ecran_inv(padding); }
window.onresize = function() { largeur_ecran(padding); }

function element(element,type)
{
	if (navigator.userAgent.indexOf("MSIE") != "-1") { return document.all(element); }
	else if (type == "id") { return document.getElementById(element); }
	else if (type == "class") { return document.getElementsByClassName(element); }
}
function largeur_ecran(padding)
{ if (document.body) { if (document.body.clientWidth+padding > 995) { vers_pc("995"); } else if (document.body.clientWidth+padding > 720) { vers_pc("720"); } else { vers_mobile(); } } }
function largeur_ecran_inv(padding)
{ if (document.body) { if (!(document.body.clientWidth+padding > 995)) { vers_pc("995"); } else if (!(document.body.clientWidth+padding > 720)) { vers_pc("720"); } else { vers_mobile(); } } }
function vers_pc(size)
{
	var entete = element("entete","id");
	var contenu = element("contenu","id");
	var pied = element("pied","id");
	var textlogo = element("textlogo","id");
	if (element("contenuombres","id")) { var contenuombres = element("contenuombres","id"); }
	if (element("popup","id")) { var popup = element("popup","id"); }
	if (element("listemobile","class")) { var listemobile = element("listemobile","class"); }
	if (element("listetab","class")) { var listetab = element("listetab","class"); }
	if (textlogo.getAttribute("face") != null)
	{ 
		// textlogo.outerHTML = "<img src=\""+racine+"jarb_x3.gif\" alt=\"Logo sJARB\" border=\"0\" id=\"textlogo\" width=\"135px\" height=\"108px\" />"; 
		textlogo.outerHTML = "<img src=\"jarb_x3.gif\" alt=\"Logo sJARB\" border=\"0\" id=\"textlogo\" width=\"135px\" height=\"108px\" />"; 
		if (popup) { popup.setAttribute("class","popuppc"); } 
	}
	if (listemobile)
	{
		var index = 0;
		var taille = listemobile.length;
		for (var i = 0 ; i < taille ; i++)
		{ 
			if (navigator.userAgent.indexOf("MSIE") != "-1") { index = i; }
			listemobile[index].className = "listepc"; 
		}
	}
	if (listetab)
	{
		for (var i = 0 ; i < listetab.length ; i++)
		{ listetab[i].setAttribute("width","310px"); }
	}
	if (size == "995")
	{
		entete.setAttribute("width","72%");
		contenu.setAttribute("width","72%");
		pied.setAttribute("width","72%");
		if (contenuombres) { contenuombres.setAttribute("width","72%"); contenu.setAttribute("width","100%"); }
	}
	else if (size == "720")
	{
		entete.setAttribute("width","702px");
		contenu.setAttribute("width","702px");
		pied.setAttribute("width","702px");
		if (contenuombres) { contenuombres.setAttribute("width","702px"); contenu.setAttribute("width","100%"); }
	}
}
function vers_mobile()
{
	var entete = element("entete","id");
	var contenu = element("contenu","id");
	var pied = element("pied","id");
	var textlogo = element("textlogo","id");
	if (element("contenuombres","id")) { var contenuombres = element("contenuombres","id"); }
	if (element("popup","id")) { var popup = element("popup","id"); }
	if (element("listepc","class")) { var listepc = element("listepc","class"); }
	if (element("listetab","class")) { var listetab = element("listetab","class"); }
	if (entete.getAttribute("width")+"" != "100%")
	{
		entete.setAttribute("width","100%");
		contenu.setAttribute("width","100%");
		pied.setAttribute("width","100%");
		if (contenuombres) { contenuombres.setAttribute("width","100%"); contenu.setAttribute("width","100%"); }
		if (popup) { popup.setAttribute("class","popupmobile"); }
		if (textlogo.getAttribute("src") != null) 
		{ textlogo.outerHTML = "<font face=\"Helvetica,sans-serif\" size=\"6\" color=\""+soustitre+"\" id=\"textlogo\"><b>Sign&#233; JARB</b></font>"; }
		if (listepc)
		{
			var taille = listepc.length;
			for (var i = 0 ; i < taille ; i++)
			{ listepc[0].setAttribute("class","listemobile"); }
		}
		if (listetab)
		{
			for (var i = 0 ; i < listetab.length ; i++)
			{ listetab[i].setAttribute("width","100%"); }
		}
	}
}