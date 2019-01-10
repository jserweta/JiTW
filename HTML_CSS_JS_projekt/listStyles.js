// Listowanie stylów
function listStyles() {
	var list = ""; 
	for (var i = 0; (styl = document.getElementsByTagName("link")[i]); i++) {
		if (styl.getAttribute("title")) {
			title = styl.getAttribute("title"); 
			list += "<a href=\"#\" onclick=\"setStyle(\'" + title + "\'); return false;\">Zmień styl na " + title + ".</a>"; 
		}
	}
	document.getElementById("styleList").innerHTML = list; // Wpisanie w element z id="styleList" stworzonego stringa
}

// Ustawienie stylu
function setStyle(name) {
	var styl;
	for (var i = 0; (styl = document.getElementsByTagName("link")[i]); i++) {
		if (styl.getAttribute("title")) {
			styl.disabled = true;
			if (styl.getAttribute("title") == name) styl.disabled = false; 
		}
	}
}

// Pobranie atrybutu title aktywnego stylu
function getStyle() {
	var styl;
	for (var i = 0; (styl = document.getElementsByTagName("link")[i]); i++) {
		if (styl.getAttribute("title") && !styl.disabled) return styl.getAttribute("title");
	}
	return null;
}

// Stworzenie ciasteczka dla stylu
function createCookie(name, styl, days) {
	if (days) { 
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000)); 
		var expires = "; expires=" + date.toGMTString(); 
  	}
	else expires = "";
	document.cookie = name + "=" + styl + expires + "; path=/"; 
}

// Odczytywanie ciasteczka stylu
function readCookie(name) {
	var name = name + "="; 
	var cookieArray = document.cookie.split(';'); 

	for(var i = 0; i < cookieArray.length; i++) { 
		var c = cookieArray[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length); 
		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
	}
	return null;
}

// Co ma sie stac przy ladowaniu strony
window.onload = function(e) {
	var styleCookie = readCookie("style");
	var styleTitle = styleCookie ? styleCookie : getStyle();
	setStyle(styleTitle);
}

// Co ma sie stac przy opuszczaniu strony
window.onunload = function(e) {
	var styleTitle = getStyle();
	createCookie("style", styleTitle, 10);
}

// Zeby przy zmianie na inna podstrone pozostawal ustawiony styl
var styleCookie = readCookie("style");
var styleTitle = styleCookie ? styleCookie : getStyle();
setStyle(styleTitle);
