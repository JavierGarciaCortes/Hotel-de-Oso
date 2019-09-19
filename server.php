<?php
class Compartir{
    private $db;
	
    function __construct(){
        include 'accesobd.php';
        $this->db=$this->conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
    }
    private function conecta ($dbHost, $dbUser, $dbPass, $dbName){
        $db= new mysqli ($dbHost, $dbUser, $dbPass, $dbName);
        if($db->connect_error){
            die("No se puede conectar: ".$db->connect_error);
        }
        return $db;
    }	   	 		// Conecta con la BD
    private function filtrarResU8($variable){
        $dato=$this->db->real_escape_string($variable);
        $dato = utf8_encode($dato);
		return $dato;
	} 									// Filtros real_escape_string y utf8_encode
    private function checkId($check){
        $clientesId[]=0;
        $check=$this->filtrarResU8($check);
        $sql="SELECT id_client FROM clients";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        foreach($datos as $valor){
            foreach ($valor as $num){
                $clientesId[]=$num;
            }
        }
        $clave=array_search($check,$clientesId);
        return $clave;
    } 							       			// comprueba si la Id del usuario existe
    function showReservasId($id){ 
        $id=$this->filtrarResU8($id);
        $datos=[];
        $sql="SELECT c.id_client, name, surname, entrada, sortida, room FROM clients c JOIN reserves r ON c.id_client ='$id' AND c.id_client = r.id_client ORDER BY entrada";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        return $datos;
    }												// Retorna un array con las reservas de un cliente
    function showReservasNS($name, $surname){  
        $name=$this->filtrarResU8($name);
        $surname=$this->filtrarResU8($surname);
        $datos=[];
        $sql="SELECT c.id_client, name, surname, entrada, sortida, room FROM clients c JOIN reserves r ON c.name='$name' AND c.surname='$surname' AND c.id_client = r.id_client ORDER BY entrada";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }if(empty($datos)){
            return FALSE;
        }else{
            return $datos;
        }
    
}						    		// Retorna un array con las reservas de un cliente buscandolo por nombre y apellido
    function insertarCliente($name, $surname, $email, $phone){
        $name=$this->filtrarResU8($name);
        $surname=$this->filtrarResU8($surname);
        $email=$this->filtrarResU8($email);
        $phone=$this->filtrarResU8($phone);
        $sql1="INSERT INTO clients (name, surname, email, phone) VALUES ( '$name', '$surname', '$email', '$phone')";
        $this->db->query($sql1);
        $sql2="SELECT id_client FROM clients WHERE email='$email'";
        $resultados = $this->db->query($sql2);
        $fila=$resultados->fetch_assoc();
        if (!empty($fila)){
            return $fila[id_client];
        }else{
            return FALSE;
        }
        
    }					// Añade clientes simple
    function insertarReserva($id, $entrada, $salida){
        $id=$this->filtrarResU8($id);
        $entrada=$this->filtrarResU8($entrada);
        $salida=$this->filtrarResU8($salida);  
        $dispo=$this->disponibilidad($entrada, $salida);
        $check=$this->checkId($id);
        if(!empty($check)){
            if($dispo==TRUE){
                $sql1="INSERT INTO reserves (id_client, entrada, sortida, room) VALUES  ('$id', '$entrada','$salida', 'doble')";
                $this->db->query($sql1);
                $sql2="SELECT id_reserva FROM reserves WHERE id_client='$id' AND entrada='$entrada' AND sortida='$salida'";
                $resultados = $this->db->query($sql2);
                $fila2=$resultados->fetch_assoc();
                if (!empty($fila2)){
                    return $fila2[id_reserva];
                }else{
                    return FALSE;
                } // error al hacer la reserva
            }else{ 
                return FALSE;
            } // error por fechas no disponibles
        }else{
            return FALSE;
        } // error por id desconocida
        
} 		          		    // Añade reservas
    function disponibilidad($entrada, $salida){
        $entrada=$this->filtrarResU8($entrada);
        $salida=$this->filtrarResU8($salida);
        $datos=[];
        $sql="SELECT entrada, sortida FROM reserves WHERE (entrada BETWEEN '{$entrada}' AND DATE_ADD('{$salida}', INTERVAL -1 DAY)) OR (sortida BETWEEN DATE_ADD('{$entrada}', INTERVAL 1 DAY) AND '{$salida}') OR ('{$entrada}' BETWEEN  entrada AND DATE_ADD(sortida, INTERVAL -1 DAY)) OR ('{$salida}' BETWEEN  DATE_ADD('entrada', INTERVAL 1 DAY) AND sortida)";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        if(!empty($datos)){
            // Las fechas no estan disponibles
            return FALSE;
        }else{
            return TRUE;
        }  
    } 		               		    // Comprueba reservas entrada/salida habitacion 
    function buscador($name, $surname){
        $name=$this->filtrarResU8($name);
        $surname=$this->filtrarResU8($surname);
        $datos=[];
        $sql="SELECT id_client, name, surname, email FROM clients WHERE name='$name' AND surname='$surname'";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
    return $datos;
} 										// Busca en la tabla clients el cliente segun nombre y apellido
    function addclient($name, $surname, $numDNI, $email, $phone, $dniFoto){ 
		$name=$this->filtrarResU8($name);
        $surname=$this->filtrarResU8($surname);
		$numDNI=$this->filtrarResU8($numDNI);
        $email=$this->filtrarResU8($email);
        $phone=$this->filtrarResU8($phone);
        $sql="INSERT INTO clients (name, surname, dni, email, phone, dniFoto) VALUES ( '$name', '$surname', '$numDNI', '$email', '$phone', '$dniFoto')";
        $this->db->query($sql);
		$sql2="SELECT id_client FROM clients WHERE email='$email'";
        $resultados = $this->db->query($sql2);
        $fila=$resultados->fetch_assoc();
        if (!empty($fila)){
            return $fila[id_client];
        }else{
            return FALSE;
        }
    } 	// Añade clientes completa
	function addReserva($numUser, $entrada, $salida, $room){
		$numUser=$this->filtrarResU8($numUser);
        $entrada=$this->filtrarResU8($entrada);
        $salida=$this->filtrarResU8($salida); 
		$room=$this->filtrarResU8($room);
        $dispo=$this->checkdates($room, $entrada, $salida);
        $check=$this->checkId($id);
        if(!empty($check)){
			if($dispo==TRUE){
				$sql="INSERT INTO reserves (id_client, entrada, sortida, room) VALUES  ('$numUser', '$entrada','$salida', '$room')";
    			$this->db->query($sql);
				$sql2="SELECT id_reserva FROM reserves WHERE id_client='$numUser' AND entrada='$entrada' AND sortida='$salida'";
        		$resultados = $this->db->query($sql2);
				$fila2=$resultados->fetch_assoc();
                if (!empty($fila2)){
					return $fila2[id_reserva];
                }else{
                    return FALSE;
                } // error al hacer la reserva
			}else{ 
				return FALSE;
			} // error por fechas no disponibles
        }else{
            return FALSE;
        } // error por id desconocida
} 					// Añade reservas
	function checkdates($room, $entrada, $salida){
        $datos=[];
        $sql="SELECT entrada, sortida, room FROM reserves WHERE room='{$room}' AND ((entrada BETWEEN '{$entrada}' AND DATE_ADD('{$salida}', INTERVAL -1 DAY)) OR (sortida BETWEEN DATE_ADD('{$entrada}', INTERVAL 1 DAY) AND '{$salida}') OR ('{$entrada}' BETWEEN  entrada AND DATE_ADD(sortida, INTERVAL -1 DAY)) OR ('{$salida}' BETWEEN  DATE_ADD('entrada', INTERVAL 1 DAY) AND sortida))";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        if(!empty($datos)){
            // Las fechas no estan disponibles
            return FALSE;
        }else{
            return TRUE;
        }  
        
    } 				// Comprueba reservas entrada/salida/room habitacion
}

$opciones["uri"]="http://100.100.100.40/HotelDelOso/server.php";
$servidor= new SoapServer(NULL, $opciones);
$servidor->setClass("Compartir");
$servidor->handle();
?>
