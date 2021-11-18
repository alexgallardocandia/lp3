<?php 
	require 'clases/conexion.php';
	
	session_start();

	$sql = "select sp_grupos(".$_REQUEST['accion'].",".$_REQUEST['vgru_cod'].",'".$_REQUEST['vgru_nombre']."') as resul";

	$datos = consultas::get_datos($sql);

	if ($datos != null) {
		$loc = explode("*", $datos[0]['resul']);
		$_SESSION['mensaje'] = $loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje'] = "Error".$sql;
		header("location:grupo_index.php");
	}

 ?>