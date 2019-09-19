<?php
session_start();
include 'objetos.php';
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Solicitud de reserva</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="js/datos1.js"></script>
	<link rel="stylesheet" href="css/estilo.css">
	<style>
		#hotelfield {
			width: 300px;
			margin: 70px auto;
			display: flex; 
			flex-direction: column;
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
				<div id="banertitle">Solicitud de reserva</div>
				<div id="logobaner"><a href="index.html"><img src="img/logo-oso.png" alt="Logo Hotel del Oso"></a></div>
			</div>
		</div>
	</header>
	<?php
if ($_SESSION['acceso']!=1){
    ?>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
		<div id="form">
			<div class="datos_reserva">
				<fieldset>
					<legend>solicitar reserva</legend>
					Datos obligatorios(*)
					<div class="linea">
						<label for="nombre">Nombre*</label>
						<input type="text" name="nombre" placeholder="Nombre" value="<?php if(!$enviado && isset($nombre)) echo $nombre; ?>" required>
					</div>
					<div class="linea">
						<label for="apellidos">Apellidos*</label>
						<input type="text" name="apellidos" placeholder="Apellidos" value="<?php if(!$enviado && isset($apellidos)) echo $apellidos; ?>" required>
					</div>
					<div class="linea">
						<label for="email">Email*</label>
						<input type="email" name="email" placeholder="Email" value="<?php if(!$enviado && isset($email)) echo $email; ?>" required>
					</div>
					<div class="linea">
						<label for="telefono">Teléfono*</label>
						<input type="number" name="telefono" placeholder="Teléfono" value="<?php if(!$enviado && isset($telefono)) echo $telefono; ?>" required>
					</div>
					<div class="linea">
						<label for="entrada">Entrada*</label>
						<input type="date" name="entrada" value="<?php if(!$enviado && isset($entrada)) echo $entrada; ?>" required></div>
					<div class="linea">
						<label for="salida">Salida*</label>
						<input type="date" name="salida" value="<?php if(!$enviado && isset($salida)) echo $salida; ?>" required>
					</div>
					<div class="linea">
						<label for="personas">Número de personas</label>
						<input type="number" name="personas" value="1" min="1" max="50">
					</div>
					<div class="linea">
						<label for="adultos">Adultos</label>
						<input type="number" name="adultos" value="1" min="1" max="50">

						<label for="kids">Niños</label>
						<input type="number" name="kids" value="0" min="0" max="20">
					</div>
					<div class="linea">
						<label for="room_type">Tipo de habitación</label>
						<select name="room_type" id="">
							<option value="-1">------------</option>
							<option value="Individual">Individual</option>
							<option value="Doble">Doble</option>
							<option value="Familiar">Familiar</option>
						</select>
					</div>
					<div class="linea">
						<label for="rooms">Número de habitaciones</label>
						<input type="number" name="rooms" value="1" min="1" max="99">
					</div>
				</fieldset>
			</div>
			<div class="peticiones">
				<fieldset>
					<legend>Peticiones adicionales</legend>
					<div class="linea">
						<textarea name="mensaje" placeholder="Escribe aqui tus peticiones"><?php if(!$enviado && isset($mensaje)) echo $mensaje; ?></textarea>
					</div>
				</fieldset>
			</div>
		</div>
		<div id="botones">
			<div class="boton" style="text-align: center;"><input type="submit" name="solicitar" value="Enviar"></div>
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
					echo "<div id='resultados'><div class='msg ok'><p>\n"; 
					echo $mensaje_ok;
                	echo "</p></div></div>\n";
					
                }else{
                    $enviado=false; 
					echo "<div id='resultados'><div class='msg error'><p>\n"; 
					echo $errores."<br>"; 
					echo "Formulario no se ha podido enviar correctamente<br>";
                	echo "</p></div></div>\n";
					
                }
         
    }
}
        ?>
    <div id="centrartodo">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method="post">
			<fieldset id="hotelfield">
				<legend>Uso personal hotel</legend>
				<label for="usuario">Introduzca su identificación:</label>
				<input type="text" name="usuario" id="usuario" autocomplete="off">
				<br>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password">
				<br>
				<input type="submit" value="Iniciar sesión" name="enviar">
			</fieldset>
		</form> <!-- Formulario entrar sesion -->
	</div>
	<?php
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    $pwc=file_get_contents("password.txt");
    if(!strcmp($usuario, file_get_contents("user.txt")) && password_verify($password,$pwc)) { 
        session_start();
        $_SESSION['acceso']=1;
        header("location:solicitudReserva.php ");
    }// comprobar usuario y contraseña
	?>


	<?php
}else{ ?>
	<div id="centrartodo">
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
				location.href = "zonareservas.php";
			}

		</script>
		<button id="cerrar">Cerrar sesion</button>
		<button id="reservas">zona reservas</button>
		<div id="formularios">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" enctype="multipart/form-data">
				<div id="form">
					<div class="datos_client">
						<fieldset>
							<legend>Nuevo Cliente</legend>
							<div class="linea">
								<label for="nom">Nombre</label>
								<input type="text" name="nom" placeholder="Nombre" required>
							</div>
							<div class="linea">
								<label for="cognom">Apellidos</label>
								<input type="text" name="cognom" placeholder="Apellidos" required>
							</div>
							<div class="linea">
								<label for="dni">DNI/NIE</label>
								<input type="text" name="numDNI" placeholder="DNI/NIE" required maxlength="10">
							</div>
							<div class="linea">
								<label for="adress">Email</label>
								<input type="email" name="email" placeholder="Dirección" required>
							</div>
							<div class="linea">
								<label for="telefono">Teléfono</label>
								<input type="number" name="telefon" placeholder="Teléfono" maxlength="9" required>
							</div>
							<div class="linea">
								<label for="foto">Foto DNI</label>
								<input type="file" name="nombre_archibo_cliente">
							</div>
							<div class="linea">
								<input type="submit" name="enviarAdd" value="Cliente nuevo">
							</div>
						</fieldset>
					</div>
				</div>

			</form> <!-- Nuevo cliente -->
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
				<div id="form">
					<div class="datos_reserva">
						<fieldset>
							<legend>Datos reserva</legend>
							<div>Registrarse antes de reservar fecha.</div>
							<div class="linea">
								<label for="personas">Id cliente</label>
								<input type="number" name="numUser" min="1" required placeholder="Número">
							</div>
							<div class="linea">
								<label for="entrada">Entrada</label>
								<input type="date" name="entrada" value="" required>
							</div>
							<div class="linea">
								<label for="salida">Salida</label>
								<input type="date" name="salida" value="" required>
							</div>
							<div class="linea">
								<lavel for="room">Tipo habitación</lavel>
								<select name="room" id="" required>
									<option value="doble">Doble</option>
									<option value="individual">Individual</option>
									<option value="familiar">Familiar</option>
									<option value="comunicadas">Comunicadas</option>
								</select>
							</div>
							<div class="linea">
								<div class="boton"><input type="submit" name="enviarReserva" value="Reservar"></div>
							</div>
						</fieldset>
					</div>
				</div>
			</form> <!-- Nuevo reserva -->
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>">
				<div id="form">
					<div class="datos_client">
						<fieldset>
							<legend>Busca tu Id Cliente</legend>
							<div class="linea">
								<label for="nomB">Nombre</label>
								<input type="text" name="nomB" placeholder="Nombre" required>
							</div>
							<div class="linea">
								<label for="cognomB">Apellidos</label>
								<input type="text" name="cognomB" placeholder="Apellidos" required>
							</div>
							<div class="linea">
								<input type="submit" name="enviarBuscar" value="Buscar Id">
							</div>
						</fieldset>
					</div>
				</div>
			</form> <!-- Buscar Id cliente -->
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
            echo "<div class='error'>Este fichero no es un documento correcto (error: $error_n).</div>";
            $todo_ok=0;
        }
        // miramos si el fichero no sobrepasa el tamaño maximo
        if($medida>$peso_max_permes && $todo_ok==1){
            echo "<div class='error'>Tamaño archivo: ".$medida."bytes.<div>";
            echo "<div class='error'>El archivo sobrepasa el límite máximo permitido.<br>".$peso_max_permes. "bytes.</div>";
            $todo_ok=0;
        }
        // miramos si el fichero tiene formato correcto: pdf o word
        if($tipo!="jpg" && $tipo!="jpeg" && $tipo!="png" && $tipo!="raw" && $todo_ok==1){
                    echo "<div class='error'>Formato de archivo: ".$tipo."</div>";
                    echo "<div class='error'>Sólo se puede subir ficheros en formato: jpg, jpeg, png y raw.</div>";
                    $todo_ok=0;
                }
        // cambiamos nombre fichero
        if($todo_ok==1){
            $dni_sin_extension = $name."-".$numDNI ;
            $dni = $dni_sin_extension.".".$tipo;
            $ruta_archivo=$subdirectorio.$dni;
        }
        // Miramos si el estado de $todo_ok
        if($todo_ok==0) echo "<div class='error'>No se ha podido subir el fichero al servidor.</div>";
        else{ // todo correcto
            // move_uploaded_file (fichero, destino)   para subir los ficheros. nos devuelve true, si lo puede hacer
            if(move_uploaded_file ($temporal,$ruta_archivo)){
                echo "<div class='ok' style='text-align: center;'>El fichero ha sido subido correctamente al servidor con el nombre: <span class='nombre'>$dni</span></div>";
            }else {
                echo $ruta_archivo;
                echo "<div class='error'>El fichero <span class='nombre'>$dni</span> No se ha podido subir correctamente al servidor. </div>";
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
						echo "<div class='ok' style='text-align: center;'>Reserva realizada";
						echo "<a href='zonareservas.php?userID=$numUser' style='color: black;'>ZONA RESERVAS</a></div>";
					}else{
                        echo "<div class='error' style='text-align: center;'>Fechas NO disponibles en nuestro hotel.</div>";
                        echo "<div style='text-align: center; background-color: beige; color:black;'>Puedes buscar habitación en los siguientes hoteles del grupo Can Molins:</div>";
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/cliente7.php?entrada='.$entrada.'&salida='.$salida.'">7\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteUneviton.php?entrada='.$entrada.'&salida='.$salida.'">Uneviton\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/cliente19.php?entrada='.$entrada.'&salida='.$salida.'">19\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteOscar.php?entrada='.$entrada.'&salida='.$salida.'">Oscar\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteNatalia.php?entrada='.$entrada.'&salida='.$salida.'">Natalia\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteCarlos.php?entrada='.$entrada.'&salida='.$salida.'">Carlos\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteJavi.php?entrada='.$entrada.'&salida='.$salida.'">Javi\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/cliente.php?entrada='.$entrada.'&salida='.$salida.'">Hotel del Oso</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteMiquel.php?entrada='.$entrada.'&salida='.$salida.'">Miquel\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/cliente46.php?entrada='.$entrada.'&salida='.$salida.'">46\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/clienteLluis.php?entrada='.$entrada.'&salida='.$salida.'">Lluis\'s Hotel</a></div>';
                        echo '<div style="text-align: center; background-color: beige;"><a style="color:black;" href="http://localhost/HotelDelOso/clientes/cliente51.php?entrada='.$entrada.'&salida='.$salida.'">51\'s Hotel</a></div>';
                    }
				}else{ echo "<div class='error' style='text-align: center;'>La fecha de entrada no puede ser anterior a hoy</div>"; }
			}else{ echo "<div class='error' style='text-align: center;'>La fecha de salida no puede ser anterior a la de entrada</div>"; }
		}else{ echo "<div class='error' style='text-align: center;'>El Id del cliente es erroneo</div>"; }
    }   //Nueva reserva
      if(isset($_POST['enviarBuscar'])){
        $name=$hotel->filtrarResU8($_POST['nomB']);
        $surname=$hotel->filtrarResU8($_POST['cognomB']);
        $cliente=$hotel->buscarId($name, $surname);
        $hotel->imprimir($cliente);  
      }    //Buscar Id cliente
      $hotel->checkId(12);
      $hotel->imprimir($hotel->getTabla());
} 
?>

</body>

</html>
