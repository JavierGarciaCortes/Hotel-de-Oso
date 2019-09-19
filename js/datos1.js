window.onload = inicio;
var menu_visible = false;
var hotel_visible = false;
var tarifas_visible = false;


function inicio() {
	document.getElementById("burger").onclick=menu;
	document.getElementById("hotel").onclick=fnavHotel;
	document.getElementById("tarifas").onclick=fnavTarifas;
}

function menu(){
	if (menu_visible == false) {
		document.getElementById("topnaver").style.display = "flex";
		menu_visible = true;
	} else {
		document.getElementById("topnaver").style.display = "none";
		menu_visible = false;
	}
}
function fnavHotel(){
	if (hotel_visible == false) {
		document.getElementById("navHotel").style.display = "flex";
		hotel_visible = true;
		document.getElementById("navTarifas").style.display = "none";
		tarifas_visible = false;
	} else {
		document.getElementById("navHotel").style.display = "none";
		hotel_visible = false;
	}
}
function fnavTarifas(){
	if (tarifas_visible == false) {
		document.getElementById("navTarifas").style.display = "flex";
		tarifas_visible = true;
		if (hotel_visible == true) {
			document.getElementById("navHotel").style.display = "none";
			hotel_visible = false;
		}
	} else {
		document.getElementById("navTarifas").style.display = "none";
		tarifas_visible = false;
	}
}