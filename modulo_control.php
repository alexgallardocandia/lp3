<?php 
	require 'clases/conexion.php';
	
	session_start();

	$sql = "select sp_modulos(".$_REQUEST['accion'].",".$_REQUEST['vmod_cod'].", '".$_REQUEST['vmod_nombre']."') as resul";
	//echo $sql;

	$dato = consultas::get_datos($sql);
	//echo $dato[0]['resul'];
	if ($dato != null) {
		$loc = explode("*",$dato[0]['resul']);
		$_SESSION['mensaje'] = $loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje'] = "Error: ".$sql;
		header("location:modulo_index.php");
	}

 ?>