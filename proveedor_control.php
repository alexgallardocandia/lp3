<?php 
	require 'clases/conexion.php';

	session_start();

	$sql = "select sp_proveedor(".$_REQUEST['accion'].",".$_REQUEST['vprv_cod'].",'".
	(!empty($_REQUEST['vprv_ruc'])?$_REQUEST['vprv_ruc']:"0")."','".
	(!empty($_REQUEST['vprv_razonsocial'])?$_REQUEST['vprv_razonsocial']:"0")."','".
	(!empty($_REQUEST['vprv_direccion'])?$_REQUEST['vprv_direccion']:"0")."','".
	(!empty($_REQUEST['vprv_telefono'])?$_REQUEST['vprv_telefono']:"0")."') as resul";
	//echo $sql;/*
	$dato = consultas::get_datos($sql);
	
	if ($dato != null) {
		$_SESSION['mensaje'] = $dato[0]['resul'];
		header("location:proveedor_index.php");
	}else{
		$_SESSION['mensaje'] = "Error :".$sql;
		header("location:proveedor_index.php");
	}
 ?>