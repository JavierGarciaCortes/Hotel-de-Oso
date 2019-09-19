<?php

class HotelBd{
    public $db;
	
    function __construct(){
        include 'accesobd.php';
        $this->db=$this->conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
    }
    function conecta ($dbHost, $dbUser, $dbPass, $dbName){
        $db= new mysqli ($dbHost, $dbUser, $dbPass, $dbName);
        if($db->connect_error){
            die("No se puede conectar: ".$db->connect_error);
        }
        return $db;
    }			// Conecta con la BD
    function getTabla(){
        $datos=[];
        $sql="SELECT id_client, name, surname, dni, email, phone, dniFoto FROM clients";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        return $datos;
    }											// Retorna un array con los datos de la tabla clientes
    function showReservas(){ 
        $datos=[];
        $sql="SELECT c.id_client, name, surname, entrada, sortida, room FROM clients c JOIN reserves r ON c.id_client = r.id_client ORDER BY entrada";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        return $datos;
    }										// Retorna un array con los clientes con reserva
    function imprimir($datos){ 
        echo "<div id='tabla'><table>";
        echo "<tr>";
        foreach ($datos as $key=>$value){ 
            foreach ($value as $key=>$values){
                $mykey[] = $key;
            }
        }// para sacar los titulos de la tabla
        for($i=0; $i<count($value); $i++){
            echo "<th>$mykey[$i]</th>";
        }// Imprime los titulos 
        echo "</tr>";
        foreach ($datos as $valor){
            echo "<tr> \n";
            foreach ($valor as $dato){
                $dato = utf8_decode($dato); //decodifica la codificación utf8
                echo "<td>$dato</td>";
            }
            echo "</tr> \n";
        } // Imprime los datos de la tabla
        echo "</table></div>";
    }										// Imprime arrays en tablas
    function addclient($name, $surname, $numDNI, $email, $phone, $dniFoto){ 
        $sql="INSERT INTO clients (name, surname, dni, email, phone, dniFoto) VALUES ( '$name', '$surname', '$numDNI', '$email', '$phone', '$dniFoto')";
        $this->db->query($sql);
    }			// Añade clientes
    function addReserva($numUser, $entrada, $salida, $room){
		$sql="INSERT INTO reserves (id_client, entrada, sortida, room) VALUES  ('$numUser', '$entrada','$salida', '$room')";
    	$this->db->query($sql);
} 		// Añade reservas
    function checkId($check){
        $clientesId[]=0;
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
    } 										// comprueba si la Id del usuario existe
    function buscarId($name, $surname){
        $datos=[];
        $sql="SELECT id_client, name, surname, phone, email FROM clients WHERE name='$name' AND surname='$surname'";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
    return $datos;
} 							// busca en la tabla clients el cliente segun nombre y apellido
    function filtrarResU8($variable){
        $dato=$this->db->real_escape_string($variable);
        $dato = utf8_encode($dato);
		return $dato;
	} 								// Filtros real_escape_string y utf8_encode
    function showReservasId($id){  
    $datos=[];
    $sql="SELECT id_reserva, name, surname, entrada, sortida, room FROM clients c JOIN reserves r ON c.id_client=$id AND c.id_client = r.id_client ORDER BY entrada";
    $resultados = $this->db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
	if(!empty($datos)){
        $this->imprimirEdit($datos, $id);
    }else{echo "<div class='error'>Este cliente no tiene reserva</div>";}
    
}									// Retorna un array con los clientes con reserva segun su id
    function showReservasNS($name, $surname){  
        $datos=[];
        $sql="SELECT c.id_client, name, surname, entrada, sortida FROM clients c JOIN reserves r ON c.name='$name' AND c.surname='$surname' AND c.id_client = r.id_client ORDER BY entrada";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }if(empty($datos)){
            echo "<div class='error'>Cliente desconocido</div>";
        }else{
            $this->imprimir($datos);
        }
    
}						// Retorna un array con los clientes con reserva segun su nombre y apellido
    function imprimirEdit($datos, $id){ 
    foreach ($datos as $key=>$value){ 
        foreach ($value as $key=>$values){
            $mykey[] = $key;
        }
    }// para sacar los titulos de la tabla
    echo "<table id='table2'>";
    echo "<tr>";
    echo "<th>Id reserva</th>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Room</th>";
    echo "<th>Entrada</th>";
    echo "<th>Salida</th>"; 
    echo "<th>Modificar</th>";
    echo "</tr>";
    $numRes=count($datos);
    for  ($i=0; $i<$numRes; $i++){
        echo "<tr>\n ";
        echo "<td><form method='get'>".$datos[$i][id_reserva]." <button type='submit' name='Borrar' value='".$datos[$i][id_reserva]."'>Borrar</button></form></td>";
        echo "<td>".$datos[$i][name]."</td>";
        echo "<td>".$datos[$i][surname]."</td>";
        echo "<form method='get'>";
        echo "<td><select name='room'><option value='".$datos[$i][room]."'>".$datos[$i][room]."</option><option value='doble'>Doble</option><option value='individual'>Individual</option><option value='familiar'>Familiar</option><option value='comunicadas'>Comunicadas</option></select></td>";
        echo "<td><input type='date' name='entrada' value='".$datos[$i][entrada]."'></td>";
        echo "<td><input type='date' name='sortida' value='".$datos[$i][sortida]."'></td>";
        echo "<td><button type='submit' name='Modificar' value='".$datos[$i][id_reserva]."'>Modificar</button></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
    echo "</table>";
     }							// Imprime arrays en tabla y puedes eliminar o editar
    function getTablaElmMost($elm,$mostr){  
    $datos=[];
    $sql="SELECT c.id_client, name, surname, entrada, sortida FROM clients c JOIN reserves r ON c.id_client = r.id_client ORDER BY entrada LIMIT $elm,$mostr;";
    $resultados = $this->db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}							// de $tabla muestra a partir de $elm $mostr elementos
    function showNumTable2(){
    $sql="SELECT c.id_client, name, surname, entrada, sortida FROM clients c JOIN reserves r ON c.id_client = r.id_client ORDER BY entrada";
    $resultados = $this->db->query($sql);
    $rows=$resultados->num_rows;
    if(empty($_GET['pag'])){
        echo "<div id='pas'><div ><a style='font-weight: bold;color: black' href='zonareservas.php?pag=1&num=3'>3</a></div>";
        echo "<div><a style='font-weight: bold;color: black' href='zonareservas.php?pag=1&num=4'>4</a></div>";
        echo "<div><a style='font-weight: bold;color: black' href='zonareservas.php?pag=1&num=5'>5</a></div></div>";
        $this->imprimir($this->showReservas());
    }else{
        if($_GET['pag']==1){
            $num=$_GET['num'];
            $elm=0;
            echo "<div id='pas'><div><a style='font-weight: bold;color: black' href='zonareservas.php?pag=0'>Todos</a></div>";
            echo "<div><a style='font-weight: bold;color: black' href='zonareservas.php?pag=2&num=$num'>Next</a></div></div>";
        }else{
            $pag=$_GET['pag'];
            $num=$_GET['num'];
            $elm=($pag-1)*$num;
            $PrePag=$pag-1;
            echo "<div id='pas'><a style='font-weight: bold;color: black' href='zonareservas.php?pag=$PrePag&num=$num'>Prev</a>";
            if($elm+$num<$rows){
                $NextPag=$pag+1;
                echo "<a style='font-weight: bold;color: black' href='zonareservas.php?pag=$NextPag&num=$num'>Next</a></div>";
            }else{ 
                echo "<div><a style='font-weight: bold;color: black' href='zonareservas.php?pag=0'>Todos</a></div>";
                echo "</div>"; 
                 }
        }
        $this->imprimir($this->getTablaElmMost($elm, $num));
    }
} 										// muestra toda la $tabla, o paginado en 3,4 o 5 elementos
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
            $dispo=0;
            return $dispo;
        }else{
            $dispo=1;
            return $dispo;
        }  
        
    } 				// Comprueba reservas entrada/salida/room habitacion
    function checkdatesMod($room, $entrada, $salida, $idre){
        $datos=[];
        $sql="SELECT entrada, sortida, room FROM reserves WHERE id_reserva <> {$idre} AND room='{$room}' AND ((entrada BETWEEN '{$entrada}' AND DATE_ADD('{$salida}', INTERVAL -1 DAY)) OR (sortida BETWEEN DATE_ADD('{$entrada}', INTERVAL 1 DAY) AND '{$salida}') OR ('{$entrada}' BETWEEN  entrada AND DATE_ADD(sortida, INTERVAL -1 DAY)) OR ('{$salida}' BETWEEN  DATE_ADD('entrada', INTERVAL 1 DAY) AND sortida))";
        $resultados = $this->db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        if(!empty($datos)){
            echo "<div class='error'>Las fechas no estan disponibles</div>";
            $dispo=0;
            return $dispo;
        }else{
            $dispo=1;
            return $dispo;
        }  
        
    } 		// Comprueba reservas entrada/salida/room habitacion excluyendo la reserva a modificar
}


?>