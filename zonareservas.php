<?php
session_start();
include 'objetos.php';
$hotel=new HotelBd(); // creo objeto
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Zona reservas | Hotel del Oso</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		img {
			width: 100%;
			vertical-align: bottom;
		}

	</style>
</head>

<body>
	<header>
		<div class="container-fluid border bg-light">
			<div class="container">
				<div class="row align-items-center no-gutters">
					<div class="col-7 col-md-3"><a href="index.html"><img src="img/logo-oso.png" alt="Logo Hotel del Oso" style="max-width: 120px"></a></div>
					<div class="col">
						<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-end">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavDropdown">
								<ul class="navbar-nav">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											HOTEL
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
											<a class="dropdown-item disabled" href="#">LAS HABITACIONES</a>
											<a class="dropdown-item disabled" href="#">LOS ESPACIOS</a>
										</div>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											RESTAURANTE
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
											<a class="dropdown-item disabled" href="#">ESPECIALIDADES</a>
											<a class="dropdown-item disabled" href="#">RECETAS</a>
											<a class="dropdown-item" href="http://clubcalidadcantabriainfinita.es/es/" target="_blank">EL CLUB DE CALIDAD</a>
										</div>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											TARIFAS
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
											<a class="dropdown-item" href="promociones.html">PROMOCIONES</a>
											<a class="dropdown-item" href="solicitudReserva.php">SOLICITUD RESERVA</a>
											<a class="dropdown-item" href="zonareservas.php">ZONA RESERVAS</a>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link disabled" href="#">DONDE ESTAMOS</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="picos_de_europa.html">PICOS DE EUROPA</a>
									</li>
									<li class="nav-item">
										<a class="nav-link disabled" href="#">RUTAS</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Barra negra -->
	<div class="container-fluid p-0" style="background-color: black">
		<div class="container">
			<nav class="row" aria-label="breadcrumb">
				<ol class="breadcrumb m-0" style="background-color: black">
					<li class="breadcrumb-item"><a href="index.html">HOME</a></li>
					<li class="breadcrumb-item active" aria-current="page">ZONA RESERVAS</li>
				</ol>
			</nav>
			<div class="row pl-3">
				<h3 style="color: white;">ZONA RESERVAS</h3>
			</div>
		</div>
	</div>

		<main class="container">
			<?php
        error_reporting(0);
        if ($_SESSION['acceso']==1){
        ?>
			<a class="btn btn-primary btn-sm" href="CerrarSesiones.php" role="button">Cerrar sesion</a>
			<a class="btn btn-primary btn-sm" href="solicitudReserva.php" role="button">Solicitud reservas</a>
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
                    $hotel->showReservasId($numID);
                }else{
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
		</main>
		<footer>
			<div class="container-fluid border bg-light">
				<div class="container">
					<div class="row align-items-center no-gutters">
						<div class="d-flex justify-content-center col-md-4"><a href="http://clubcalidadcantabriainfinita.es/es/" target="_blank"><img src="img/logoclubdecalidad.jpg" alt="Logo Club Caldad Cantabria Infinita"></a></div>
						<div class="col">
							<div class="row">
								<div class="col-12 d-flex justify-content-center"><a href="https://www.facebook.com/Hoteldeloso/" target="_blank"><img src="https://img.icons8.com/color/48/000000/facebook.png"></a></div>
							</div>
							<div class="row">
								<div class="col-12 d-flex justify-content-center">Cosgaya (Cantabria) Spain. Tel. +34 942 733 018 info@hoteldeloso.com</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
