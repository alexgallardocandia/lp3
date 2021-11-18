<?php 
	require 'clases/conexion.php';
	
	session_start();

	$sql = "select sp_sucursal(".$_REQUEST['accion'].", ".$_REQUEST['vid_sucursal'].", '".$_REQUEST['vsuc_descri']."') as resul;";

	$dato = consultas::get_datos($sql);


	if ($dato != null) {
		$loc=explode("*", $dato[0]['resul']);
		$_SESSION['mensaje']=$loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje'] = "Error ". $sql;
		header("location:sucursal_index.php");
	}

 ?>