var tBaja = ["T.Baja", "72,60", "60,50", "109,00", "120,00", "5,50", "11,00", "4,50"];
var tMedia = ["T.Media", "79,50", "64,00", "117,70", "128,70", "5,50", "11,00", "4,50"];
var tAlta = ["T.Alta", "91,80", "73,00", "132,00", "141,00", "5,50", "11,00", "4,50"];
var nombreHabitacion = ["", "Doble", "Individual", "Familiar", "Habitaciones comunicadas", "Desayuno bufet (hasta 10 años)", "Desayuno bufet (a partir de 10 años)", "Mini-desayuno (en bar)"];
window.onload = inicio;
var menu_visible = false;
var hotel_visible = false;
var tarifas_visible = false;


function inicio() {
	document.getElementById("burger").onclick=menu;
	document.getElementById("hotel").onclick=fnavHotel;
	document.getElementById("tarifas").onclick=fnavTarifas;
	tablaprecios();
}
function tablaprecios() {
	document.getElementById("tablaprecios").innerHTML += `<div class="lineaP" id="linea0"><div class="nombreHabitacion">${nombreHabitacion[0]}</div><div class="tBaja">${tBaja[0]}</div><div class="tMedia">${tMedia[0]}</div><div class="tAlta">${tAlta[0]}</div></div>`;
	for(i=1;i<nombreHabitacion.length; i++) {
		document.getElementById("tablaprecios").innerHTML += `<div class="lineaP" id="linea${i}"><div class="nombreHabitacion">${nombreHabitacion[i]}</div><div class="tBaja">${tBaja[i]}€</div><div class="tMedia">${tMedia[i]}€</div><div class="tAlta">${tAlta[i]}€</div></div>`;
		}
	document.getElementById("tablaprecios").innerHTML += `<div class="lineaP"><div class="nombreHabitacion">Cama supletoria</div><div class="tBaja">A partir de</div><div class="tMedia">11 años - </div><div class="tAlta">15,00€</div></div>`;
	document.getElementById("tablaprecios").innerHTML += `<div class="lineaP"><div class="nombreHabitacion">Cuna</div><div class="cuna">Bajo petición</div></div>`;
	document.getElementById("tablaprecios").innerHTML += `<div class="lineaP"><div class="nombreHabitacion">10% IVA incluido en todos los precios</div></div>`;
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