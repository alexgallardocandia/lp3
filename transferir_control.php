<?php
	require 'clases/conexion.php';

	session_start();

	$sql = "select sp_transferencia(
							".$_REQUEST['accion'].",
					    ".$_REQUEST['vtrans_cod'].",
					    ".$_REQUEST['vid_sucursal_origen'].",
					    ".$_REQUEST['vid_sucursal_destino'].") as resul;";
	//echo $sql;/*
	$resultado = consultas::get_datos($sql);
//	echo $resultado[0]['resul'];

	if ($resultado[0]['resul'] != null) {
	    $loc = explode("*",$resultado[0]['resul']);
	    $_SESSION['mensaje'] = $loc[0];
	    header("location:".$loc[1]);
	} else {
	    $_SESSION['mensaje'] = "Error:".$sql;
	    header("location:transferir_index.php");
	}


 ?>
