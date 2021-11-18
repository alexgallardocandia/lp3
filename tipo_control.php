<?php 
	require 'clases/conexion.php';
	
	session_start();

	$sql = "select sp_tipo(".$_REQUEST['accion'].",".$_REQUEST['vtipo_cod'].",'".$_REQUEST['vtipo_descri']."',".
			(!empty($_REQUEST['vtipo_porcen'])?$_REQUEST['vtipo_porcen']:"0").") as resul";
		

	$dato = consultas::get_datos($sql);


	if ($dato != null) {
		$loc = explode("*", $dato[0]['resul']);
		$_SESSION['mensaje'] = $loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje']='Error '. $sql;
		header("location:tipo_index.php");
	}

 ?>