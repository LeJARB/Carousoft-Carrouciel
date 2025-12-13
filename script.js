var padding = 20;
if (navigator.userAgent.indexOf("MSIE 4") != "-1" || navigator.userAgent.indexOf("MSIE 5") != "-1") { padding = 0; window.onload = function () { width(padding); } }
else { width(padding); }
window.onorientationchange = function () { width_inv(padding); }
window.onresize = function () { width(padding); }

function element(element, type) {
	if (navigator.userAgent.indexOf("MSIE") != "-1") { return document.all(element); }
	else if (type == "id") { return document.getElementById(element); }
	else if (type == "class") { return document.getElementsByClassName(element); }
}

function width(padding) { if (document.body) { if (document.body.clientWidth + padding > 1280) { pc("1280"); } else if (document.body.clientWidth + padding > 720) { pc("720"); } else { mobile(); } } }
function width_inv(padding) { if (document.body) { if (!(document.body.clientWidth + padding > 1280)) { pc("1280"); } else if (!(document.body.clientWidth + padding > 720)) { pc("720"); } else { mobile(); } } }

function pc(size)
{
	var content = element("content","id");
	if (size == "1280")
	{
		if (element("thumblistmobile","class")) { var thumblistmobile = element("thumblistmobile","class"); }
		if (thumblistmobile)
		{
			var index = 0;
			var taille = thumblistmobile.length;
			for (var i = 0 ; i < taille ; i++)
			{ 
				if (navigator.userAgent.indexOf("MSIE") != "-1") { index = i; }
				thumblistmobile[index].className = "thumblistpc"; 
			}
		}
		if (element("thumblisttab","class")) { var thumblisttab = element("thumblisttab","class"); }
		if (thumblisttab)
		{
			for (var i = 0 ; i < thumblisttab.length ; i++)
			{ thumblisttab[i].setAttribute("width","310px"); }
		}
		content.setAttribute("width","1080px");
	}
	else if (size == "720")
	{
		if (element("thumblistmobile","class")) { var thumblistmobile = element("thumblistmobile","class"); }
		if (thumblistmobile)
		{
			var index = 0;
			var taille = thumblistmobile.length;
			for (var i = 0 ; i < taille ; i++)
			{ 
				if (navigator.userAgent.indexOf("MSIE") != "-1") { index = i; }
				thumblistmobile[index].className = "thumblistpc"; 
			}
		}
		if (element("thumblisttab","class")) { var thumblisttab = element("thumblisttab","class"); }
		if (thumblisttab)
		{
			for (var i = 0 ; i < thumblisttab.length ; i++)
			{ thumblisttab[i].setAttribute("width","310px"); }
		}
		content.setAttribute("width","700px");
	}
	if (element("infobox","id")) { var infobox = element("infobox","id"); }
	if (infobox) { infobox.setAttribute("class","infoboxpc"); }


}

function mobile()
{
	var content = element("content","id");
	content.setAttribute("width","100%");
	if (element("thumblistpc","class")) { var thumblistpc = element("thumblistpc","class"); }
	if (thumblistpc)
	{
		var taille = thumblistpc.length;
		for (var i = 0 ; i < taille ; i++)
		{ thumblistpc[0].setAttribute("class","thumblistmobile"); }
	}
	if (element("thumblisttab","class")) { var thumblisttab = element("thumblisttab","class"); }
	if (thumblisttab)
	{
		for (var i = 0 ; i < thumblisttab.length ; i++)
		{ thumblisttab[i].setAttribute("width","100%"); }
	}
	if (element("infobox","id")) { var infobox = element("infobox","id"); }
	if (infobox) { infobox.setAttribute("class","infoboxmobile"); }
		
}