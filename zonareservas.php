<?php
session_start();
include 'objetos.php';
$hotel=new HotelBd(); // creo objeto
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Check reservas</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="js/datos1.js"></script>
	<link rel="stylesheet" href="css/estilo.css">
	<style>
		#tusReservas,
		.error {
			width: 400px;
			margin: 10px auto;
		}

		.error {
			padding: 5px;
		}

		#table2 {
			width: 100%;
			background-color: dimgrey;
			text-align: center;
		}

	</style>
</head>

<body>
	<header>
		<div id="boxbaner">
			<div id="banner">
				<div id="burger"><img src="img/burger.svg" alt="menu"></div>
				<div id="topnaver">
					<div id="hotel" class="navCSS">HOTEL</div>
					<nav id="navHotel"><a href="">LAS HABITACIONES</a><a href="">LOS ESPACIOS</a></nav>
					<div id="restaurante" class="navCSS"><a href="zonareservas.php">CHECK RESERVAS</a></div>
					<div id="tarifas" class="navCSS">TARIFAS Y RESERVAS</div>
					<nav id="navTarifas"><a href="promociones.html">PROMOCIONES</a><a href="solicitudReserva.php">SOLICITUD DE RESERVA</a></nav>
				</div>
				<div id="banertitle">Check reservas</div>
				<div id="logobaner"><a href="index.html"><img src="img/logo-oso.png" alt="Logo Hotel del Oso"></a></div>
			</div>
		</div>
	</header>

	<div id="centrartodo">
		<?php
        error_reporting(0);
        if ($_SESSION['acceso']==1){
        ?>
		<script>
			window.onload = inicio;

			function inicio() {
				document.getElementById("cerrar").onclick = cerrar;
				document.getElementById("reservas").onclick = reservas;
			}

			function cerrar() {
				location.href = "CerrarSesiones.php";
			}

			function reservas() {
				location.href = "solicitudReserva.php";
			}

		</script>
		<button id="cerrar">Cerrar sesion</button>
		<button id="reservas">Solicitud reservas</button>
		<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
			<fieldset id="tusReservas">
				<legend>Tus reservas</legend>
				Busca por Id o por nombre y apellido<br>
				<div class="linea">
					<label for="userID">Id cliente</label>
					<input type="number" name="userID">
				</div>
				<div class="linea">
					<label for="name">Nombre</label>
					<input type="text" name="name" placeholder="Nombre">
				</div>
				<div class="linea">
					<label for="surname">Apellidos</label>
					<input type="text" name="surname" placeholder="Apellidos">
				</div>
				<input type="submit" name="send" value="Reservas">
			</fieldset>
		</form> <!-- Buscar por id o nombre y apellido -->
		<?php
            if(!empty($_GET['userID'])){
                $numID=$hotel->filtrarResU8($_GET['userID']);
                $check=$hotel->checkId($numID);
                if(!empty($check)){
                    echo $check;
                    $hotel->showReservasId($numID);
                }else{
                    echo $check;
                    echo "<div class='error'>El Id $numID es erroneo<div>";
                }
            }elseif(!empty($_GET['name']) && !empty($_GET['surname'])){
                $name=$hotel->filtrarResU8($_GET['name']);
                $surname=$hotel->filtrarResU8($_GET['surname']);
                $hotel->showReservasNS($name, $surname);  
            }else{
                $hotel->showNumTable2();
            }
        }else{
        ?>
		<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
			<fieldset id="tusReservas">
				<legend>Tus reservas</legend>
				<div class="linea">
					<label for="name">Nombre</label>
					<input type="text" name="name" placeholder="Nombre">
				</div>
				<div class="linea">
					<label for="surname">Apellidos</label>
					<input type="text" name="surname" placeholder="Apellidos">
				</div>
				<input type="submit" name="send" value="Reservas">
			</fieldset>
		</form> <!-- Buscarnombre y apellido -->
		<?php
            if(!empty($_GET['name']) && !empty($_GET['surname'])){
                $name=$hotel->filtrarResU8($_GET['name']);
                $surname=$hotel->filtrarResU8($_GET['surname']);
                $hotel->showReservasNS($name, $surname);
            }
        }
        ?>
	</div>
</body>

</html>
<?php
if(isset($_GET['Borrar'])){
    $id=$_GET['Borrar'];
    $sql= "DELETE FROM reserves WHERE id_reserva=$id";
    $hotel->db->query($sql);    
}
if(isset($_GET['Modificar'])){
    $idre=$_GET['Modificar'];
    $entrada=$_GET['entrada'];
    $salida=$_GET['sortida'];
    $room=$_GET['room'];
    $dispo=$hotel->checkdatesMod($room, $entrada, $salida, $idre);
    if($dispo==1){
        $sql= "UPDATE reserves SET entrada='{$entrada}', sortida='{$salida}', room='{$room}' WHERE id_reserva ={$idre}";
        $hotel->db->query($sql);
        echo "<div class='ok' style='text-align: center;'>Reserva modificada";
    } 
}
?>
