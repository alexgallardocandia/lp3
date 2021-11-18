<?php
	include 'conexion.php';
	
	echo "<strong>Nombre es:</strong>".$_REQUEST['nombre']."<br>";
	echo "<strong>Apellido es:</strong>".$_REQUEST['apellido']."<br>";
	echo "<strong>Fecha Nac.:</strong>".$_REQUEST['fecnac']."<br>";
	echo "<strong>Genero:</strong>".$_REQUEST['genero']."<br>";
	
	$sql = "insert into clientes(nombre,apellido,fec_nac,genero) 
	values ('".$_REQUEST['nombre']."','".$_REQUEST['apellido']."',
	'".$_REQUEST['fecnac']."','".$_REQUEST['genero']."')";
	
	if(consultas::ejecutar_sql($sql)){
		echo "Se inserto correctamente";
	}else{
		echo "Error al insertar ".$sql;
	}
	
	echo "<a href='formularios.html'>VOLVER</a>"
?>