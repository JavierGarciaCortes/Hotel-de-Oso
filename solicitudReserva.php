<?php
session_start();
include 'objetos.php';
error_reporting(0);
$hotel=new HotelBd(); // creo objeto
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Solicitud de reserva | Hotel del Oso</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		img {
			width: 100%;
			vertical-align: bottom;
		}

		textarea {
			max-height: 150px;
			min-height: 150px;
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
					<li class="breadcrumb-item active" aria-current="page">SOLICITUD DE RESERVA</li>
				</ol>
			</nav>
			<div class="row pl-3">
				<h3 style="color: white;">SOLICITUD DE RESERVA</h3>
			</div>
		</div>
	</div>

	<main class="container">


<?php
   if(isset($_POST['enviar'])){
	    $usuario=$_POST['usuario'];
            $password=$_POST['password'];
            $pwc='admin';
            if(!strcmp($usuario, 'admin') && !strcmp($password, 'admin')) { 
                session_start();
                $_SESSION['acceso']=1;
                header("location:solicitudReserva.php ");
            }// comprobar usuario y contraseña
    }	
    if ($_SESSION['acceso']!=1){
        ?>
		<!-- Intro  -->
		<div class="row m-4">
			<p>Rellene el siguiente formulario para solicitar su reserva.</p>
			<p>La cumplimentación de este formulario no supone la realización de la reserva. El hotel se pondrá en contacto con usted para gestionar su solicitud.</p>
		</div>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
			<div class="container">
				<div class="form-group border border-dark p-3 m-5 rounded" style="background-color: beige">
					<div class="row">
						<legend class="font-italic text-center">Solicitar reserva</legend>
					</div> <!-- Legend -->
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4">
							<div>
								<p>Datos obligatorios(*)</p>
							</div>
							<div><input type="text" name="nombre" placeholder="Nombre *" value="<?php if(!$enviado && isset($nombre)) echo $nombre; ?>" required class="form-control mb-2 form-control-sm"></div>
							<div><input type="text" name="apellidos" placeholder="Apellidos *" value="<?php if(!$enviado && isset($apellidos)) echo $apellidos; ?>" required class="form-control mb-2 form-control-sm"></div>
							<div><input type="email" name="email" placeholder="Email *" value="<?php if(!$enviado && isset($email)) echo $email; ?>" required class="form-control mb-2 form-control-sm"></div>
							<div><input type="number" name="telefono" placeholder="Teléfono *" value="<?php if(!$enviado && isset($telefono)) echo $telefono; ?>" required class="form-control mb-2 form-control-sm"></div>
							<br>
							<div><label for="entrada">Entrada*</label>
								<input type="date" name="entrada" value="<?php if(!$enviado && isset($entrada)) echo $entrada; ?>" required class="form-control mb-2 form-control-sm"></div>
							<div><label for="salida">Salida*</label>
								<input type="date" name="salida" value="<?php if(!$enviado && isset($salida)) echo $salida; ?>" required class="form-control mb-2 form-control-sm"></div>
						</div> <!-- Obligatorios -->
						<div class="col-12 col-md-6 col-lg-4">
							<label for="personas">Número de personas</label>
							<input type="number" name="personas" value="1" min="1" max="50" class="form-control mb-2 form-control-sm">
							<label for="adultos">Adultos</label>
							<input type="number" name="adultos" value="1" min="1" max="50" class="form-control mb-2 form-control-sm">
							<label for="kids">Niños</label>
							<input type="number" name="kids" value="0" min="0" max="20" class="form-control mb-2 form-control-sm">
							<label>Tipo de habitación</label>
							<select name="room_type" class="form-control mb-2 form-control-sm">
								<option value="-1">------------</option>
								<option value="Individual">Individual</option>
								<option value="Doble">Doble</option>
								<option value="Familiar">Familiar</option>
							</select>
							<label for="rooms">Número de habitaciones</label>
							<input type="number" name="rooms" value="1" min="1" max="99" class="form-control mb-2 form-control-sm">
						</div> <!-- Personas y habitacion info -->
						<div class="col-12 col-md-12 col-lg-4">
							<label for="mensaje">Peticiones adicionales</label>
							<textarea name="mensaje" class="form-control form-control-sm mb-2" placeholder="Escribe aqui tus peticiones"><?php if(!$enviado && isset($mensaje)) echo $mensaje; ?></textarea>
						</div> <!-- Peticiones -->
					</div>
					<div class="row d-flex justify-content-center">
						<button type="submit" class="btn btn-primary btn-sm" name="solicitar">Enviar</button>
					</div> <!-- Enviar -->
				</div>
			</div>
		</form>

		<?php 
		$enviado='';
		if(isset($_POST['solicitar'])){
			$errores='';
			$enviar=$_POST['solicitar'];
			$nombre=$_POST['nombre'];
			$apellidos=$_POST['apellidos'];
			$email=$_POST['email'];
			$telefono=$_POST['telefono'];
			$entrada=$_POST['entrada'];
			$salida=$_POST['salida'];
			$personas=$_POST['personas'];
			$adultos=$_POST['adultos'];
			$kids=$_POST['kids'];
			$room_type=$_POST['room_type'];
			$rooms=$_POST['rooms'];
			$mensaje=$_POST['mensaje'];
			/* Nombre */
			if(!empty($nombre)){
				$nombre=trim($nombre);
				$nombre=filter_var($nombre, FILTER_SANITIZE_STRING);
			}else{
				$errores.='Por favor, introduzca su nombre <br>';
			}
			/* apellidos */
			if(!empty($apellidos)){
				$apellidos=trim($apellidos);
				$apellidos=filter_var($apellidos, FILTER_SANITIZE_STRING);
			}else{
				$errores.='Por favor, introduzca sus apellidos <br>';
			}
			/* Email */
			if(!empty($email)){
				$email=trim($email);
				$email=filter_var($email, FILTER_SANITIZE_EMAIL);
				if(!filter_var($email,FILTER_SANITIZE_EMAIL)){
					$errores.='Por favor, introduzca un email valido';
				}
			}else{
				$errores.='Por favor, introduce un email <br>';
			}
			/* Fecha */
			$fechaentrada=strtotime ($entrada);
			$fechasalida=strtotime ($salida);
			if($fechasalida <= $fechaentrada){
				$errores.='La fecha de salida tiene que ser posterior a la de entrada. <br>';
			}
			/* Tipo */
			if($room_type==-1){
				$room_type="no ha seleccionado tipo habitación";
			}
			/* Mensaje */
			if(!empty($mensaje)){
				$mensaje=htmlspecialchars($mensaje);
				$mensaje=trim($mensaje);
				$mensaje=stripslashes($mensaje);
			}
			if(!$errores){
                $destinatario="ronins12@gmail.com";
                $asunto="Solicitud de reserva";
                $mensaje_a_enviar_desti= "De: $nombre $apellidos \n";
                $mensaje_a_enviar_desti.= "Email: $email \n";
                $mensaje_a_enviar_desti.= "Telefono: $telefono \n";
                $mensaje_a_enviar_desti.= "Fecha de estancia: $entrada al $salida \n";
                $mensaje_a_enviar_desti.= "Personas: $personas \n";
                $mensaje_a_enviar_desti.= "Adultos: $adultos \n";
                $mensaje_a_enviar_desti.= "Niños: $kids \n";
                $mensaje_a_enviar_desti.= "Tipo de habitación: $room_type \n";
                $mensaje_a_enviar_desti.= "Nº habitaciones: $rooms \n";
                $mensaje_a_enviar_desti.= "Mensaje: $mensaje \n";
                
                $remitente=$email;
                $mensaje_a_enviar_remi= "De: Hotel del Oso \n";
                $mensaje_a_enviar_remi.= "Email: info@hoteldeloso.com \n";
                $mensaje_a_enviar_remi.= "Telefono: +34 942 733 018  \n";
                $mensaje_a_enviar_remi.= "Hola $nombre $apellidos,\n";
                $mensaje_a_enviar_remi.= "Este emaile es la confirmación de que hemos recibido su solicitud de reserva. En breve nos pondremos en contacto con usted para finalizar la reserva.\n";
                $mensaje_a_enviar_remi.= "Su email es $email y su telefono $telefono. En caso negativo, le rogamos  se ponga en contacto con nosotros para poder proceder con la reserva. \n";
                $mensaje_a_enviar_remi.= "Atentamente,\n";
                $mensaje_a_enviar_remi.= "Recpción Hotel del Oso\n";
					
				$mensaje_ok=" Su solicitud de reserva de $rooms habitaciones para $personas personas a sido recibida. Recibira un email de confirmación en el correo $email. Y en breve nos podremos en contacto con usted en el $telefono para finalizar la reserva.\n";	
        
                $okEnviarEmailDesti=mail($destinatario,$asunto,$mensaje_a_enviar_desti);
                $okEnviarEmailRemi=mail($remitente,$asunto,$mensaje_a_enviar_remi);
                if($okEnviarEmailDesti && $okEnviarEmailRemi){
                    $enviado=true; 
					echo "<div id='container'><div class='alert alert-success' role='alert'><p>\n"; 
					echo $mensaje_ok;
                	echo "</p></div></div>\n";
					
                }else{
                    $enviado=false; 
					echo "<div id='container'><div class='alert alert-danger' role='alert'><p>\n"; 
					echo $errores."<br>"; 
					echo "Formulario no se ha podido enviar correctamente<br>";
                	echo "</p></div></div>\n";
					
                }
         
    }
}
        ?>

		<!-- Tabla precios  -->
		<table class="table table-borderless" style="background-image: url(img/imgn-tarifas.jpg);">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">T.Baja</th>
					<th scope="col">T.Media</th>
					<th scope="col">T.Alta</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Doble</th>
					<td>72,60€</td>
					<td>79,50€</td>
					<td>91,80€</td>
				</tr>
				<tr>
					<th scope="row">Individual</th>
					<td>60,50€</td>
					<td>64,00€</td>
					<td>73,00€</td>
				</tr>
				<tr>
					<th scope="row">Familiar</th>
					<td>109,00€</td>
					<td>117,70€</td>
					<td>132,00€</td>
				</tr>
				<tr>
					<th scope="row">Habitaciones comunicadas</th>
					<td>120,00€</td>
					<td>128,70€</td>
					<td>141,00€</td>
				</tr>
				<tr>
					<th scope="row">Cama supletoria</th>
					<td colspan="2">A partir de 11 años</td>
					<td>15€</td>
				</tr>
				<tr>
					<th scope="row">Cuna</th>
					<td colspan="3">Bajo peticion</td>
				</tr>
				<tr>
					<th scope="row">Desayuno bufet (hasta 10 años)</th>
					<td>5,50€</td>
					<td>5,50€</td>
					<td>5,50€</td>
				</tr>
				<tr>
					<th scope="row">Desayuno bufet (a partir de 10 años)</th>
					<td>11,00€</td>
					<td>11,00€</td>
					<td>11,00€</td>
				</tr>
				<tr>
					<th scope="row">Mini-desayuno (en el bar)</th>
					<td>4,50€</td>
					<td>4,50€</td>
					<td>4,50€</td>
				</tr>
				<tr>
					<th scope="row">10% IVA incluido en todos los precios</th>
				</tr>
			</tbody>
		</table>

		<div class="container d-flex justify-content-center">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method="post">
				<div class="form-group border border-dark p-3 m-5" style="width:230px; background-color: beige">
					<legend class="font-italic text-center">Uso personal hotel</legend>
					<label for="usuario">Id empleado:</label>
					<input type="text" name="usuario" class="form-control mb-2 form-control-sm">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control mb-2 form-control-sm">
					<button type="submit" class="btn btn-primary btn-sm mb-2" name="enviar">Iniciar sesión</button>
				</div>
			</form>
		</div> <!-- Formulario log in sesion -->
		<?php
            
    }else{ ?>
		<div class="container">
			<a class="btn btn-primary btn-sm" href="CerrarSesiones.php" role="button">Cerrar sesion</a>
			<a class="btn btn-primary btn-sm" href="zonareservas.php" role="button">Zona reservas</a>
			<div id="container">
				<div class="row d-flex justify-content-center">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" enctype="multipart/form-data">
						<div class="form-group border border-dark p-3 m-5 rounded" style="width:250px; background-color: beige">
							<legend class="font-italic text-center">Nuevo Cliente</legend>
							<input type="text" name="nom" placeholder="Nombre" required class="form-control mb-2 form-control-sm">
							<input type="text" name="cognom" placeholder="Apellidos" required class="form-control mb-2 form-control-sm">
							<input type="text" name="numDNI" placeholder="DNI/NIE" required maxlength="10" class="form-control mb-2 form-control-sm">
							<input type="email" name="email" placeholder="Email" required class="form-control mb-2 form-control-sm">
							<input type="number" name="telefon" placeholder="Teléfono" maxlength="9" required class="form-control mb-2 form-control-sm">
							<div class="custom-file  mb-2">
								<input type="file" class="custom-file-input" id="nombre_archibo_cliente" name="nombre_archibo_cliente" required>
								<label class="custom-file-label" for="nombre_archibo_cliente">Elegir foto DNI</label>
								<div class="invalid-feedback">Example invalid custom file feedback</div>
							</div>
							<button type="submit" class="btn btn-primary btn-sm mb-2" name="enviarAdd">Nuevo cliente</button>
						</div>
					</form> <!-- Nuevo cliente -->
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
						<div class="form-group border border-dark p-3 m-5 rounded" style="width:250px; background-color: beige">
							<legend class="font-italic text-center">Reservar habitación</legend>
							<input type="number" name="numUser" min="1" required placeholder="Id cliente" class="form-control mb-2 form-control-sm">
							<label for="entrada">Entrada</label>
							<input type="date" name="entrada" required class="form-control mb-2 form-control-sm">
							<label for="salida">Salida</label>
							<input type="date" name="salida" required class="form-control mb-2 form-control-sm">
							<lavel for="room">Tipo habitación</lavel>
							<select name="room" id="" required class="form-control mb-2 form-control-sm">
								<option value="doble">Doble</option>
								<option value="individual">Individual</option>
								<option value="familiar">Familiar</option>
								<option value="comunicadas">Comunicadas</option>
							</select>
							<button type="submit" class="btn btn-primary btn-sm mb-2" name="enviarReserva">Reservar</button>
						</div>
					</form> <!-- Nuevo reserva -->
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
						<div class="form-group border border-dark p-3 m-5 rounded" style="width:250px; background-color: beige">
							<legend class="font-italic text-center">Buscar Id Cliente</legend>
							<input type="text" name="nomB" placeholder="Nombre" required class="form-control mb-2 form-control-sm">
							<input type="text" name="cognomB" placeholder="Apellidos" required class="form-control mb-2 form-control-sm">
							<button type="submit" class="btn btn-primary btn-sm mb-2" name="enviarBuscar">Buscar Id</button>
						</div>
					</form> <!-- Buscar Id cliente -->
				</div>
			</div>
		</div>

		<?php
      if(isset($_POST['enviarAdd'])){
        $name=$hotel->filtrarResU8($_POST['nom']);
        $surname=$hotel->filtrarResU8($_POST['cognom']);
		$numDNI=$hotel->filtrarResU8($_POST['numDNI']);  
        $email=$hotel->filtrarResU8($_POST['email']);
        $phone=$hotel->filtrarResU8($_POST['telefon']);
          
        $dni=$_FILES['nombre_archibo_cliente']['name'];
        $dni_sin_extension=explode(".",$dni);
        $dni_sin_extension=$dni_sin_extension[0];
        $medida=$_FILES['nombre_archibo_cliente']['size']; 
        $kB= number_format($medida/1024,2,",","");
        $temporal=$_FILES['nombre_archibo_cliente']['tmp_name']; 
        $error_n=$_FILES['nombre_archibo_cliente']['error']; 
        $peso_max_permes= (1048576)*4; //Tamaño max: 4MB
        $subdirectorio="DNI/"; //donde lo va a subir.
        $ruta_archivo=$subdirectorio.$dni;
        $tipo=pathinfo($dni,PATHINFO_EXTENSION); //extension del archivo
        $todo_ok=0;
        if($error_n==0) {
            $todo_ok=1;
        }else{
            echo "<div class='alert alert-danger' role='alert'>Este fichero no es un documento correcto (error: $error_n).</div>";
            $todo_ok=0;
        }
        // miramos si el fichero no sobrepasa el tamaño maximo
        if($medida>$peso_max_permes && $todo_ok==1){
            echo "<div class='alert alert-danger' role='alert'>Tamaño archivo: ".$medida."bytes.<div>";
            echo "<div class='alert alert-danger' role='alert'>El archivo sobrepasa el límite máximo permitido.<br>".$peso_max_permes. "bytes.</div>";
            $todo_ok=0;
        }
        // miramos si el fichero tiene formato correcto
        if($tipo!="jpg" && $tipo!="jpeg" && $tipo!="png" && $tipo!="raw" && $todo_ok==1){
                    echo "<div class='alert alert-danger' role='alert'>Formato de archivo: ".$tipo."</div>";
                    echo "<div class='alert alert-danger' role='alert'>Sólo se puede subir ficheros en formato: jpg, jpeg, png y raw.</div>";
                    $todo_ok=0;
                }
        // cambiamos nombre fichero
        if($todo_ok==1){
            $dni_sin_extension = $name."-".$numDNI ;
            $dni = $dni_sin_extension.".".$tipo;
            $ruta_archivo=$subdirectorio.$dni;
        }
        // Miramos si el estado de $todo_ok
        if($todo_ok==0) echo "<div class='alert alert-danger' role='alert'>No se ha podido subir el fichero al servidor.</div>";
        else{ // todo correcto
            // move_uploaded_file (fichero, destino)   para subir los ficheros. nos devuelve true, si lo puede hacer
            if(move_uploaded_file ($temporal,$ruta_archivo)){
                echo "<div class='alert alert-success' role='alert'>El fichero ha sido subido correctamente al servidor con el nombre: <span class='nombre'>$dni</span></div>";
            }else {
                echo $ruta_archivo;
                echo "<div class='alert alert-danger' role='alert'>El fichero <span class='nombre'>$dni</span> No se ha podido subir correctamente al servidor. </div>";
            }
        } 
        $hotel->addclient($name, $surname, $numDNI, $email, $phone, $dni);
    }       //Nuevo cliente
      if(isset($_POST['enviarReserva'])){
        $fecha_actual = strtotime(date("Y-m-d",time()));
        $numUser=$hotel->filtrarResU8($_POST['numUser']);
        $check=$hotel->checkId($numUser);
        if($check!=null && $numUser>1){
            $entrada=$hotel->filtrarResU8($_POST['entrada']);
            $salida=$hotel->filtrarResU8($_POST['salida']);
            $room=$hotel->filtrarResU8($_POST['room']);
            if(strtotime($entrada)<strtotime($salida)){
				if(strtotime($entrada) >= $fecha_actual){
					$dispo=$hotel->checkdates($room, $entrada, $salida);
					if($dispo==1){
						$hotel->addReserva($numUser, $entrada, $salida,$room);
						echo "<div class='alert alert-success' role='alert'>Reserva realizada";
						echo "<a href='zonareservas.php?userID=$numUser' style='color: black;'>ZONA RESERVAS</a></div>";
					}else{
                        echo "<div class='alert alert-danger' role='alert'>Fechas NO disponibles en nuestro hotel.</div>";
                    }
				}else{ echo "<div class='alert alert-danger' role='alert'>La fecha de entrada no puede ser anterior a hoy</div>"; }
			}else{ echo "<div class='alert alert-danger' role='alert'>La fecha de salida no puede ser anterior a la de entrada</div>"; }
		}else{ echo "<div class='alert alert-danger' role='alert'>El Id del cliente es erroneo</div>"; }
    }   //Nueva reserva
      if(isset($_POST['enviarBuscar'])){
        $name=$hotel->filtrarResU8($_POST['nomB']);
        $surname=$hotel->filtrarResU8($_POST['cognomB']);
        $cliente=$hotel->buscarId($name, $surname);
        $hotel->imprimir($cliente);  
      }    //Buscar Id cliente
      $hotel->imprimir($hotel->getTabla());
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
