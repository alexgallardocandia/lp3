<?php 
	require 'clases/conexion.php';
	
	session_start();
	$sql = "select sp_cargo(".$_REQUEST['accion'].",".$_REQUEST['vcar_cod'].",'".$_REQUEST['vcar_descri']."') as resul;";
//echo $sql;/*	
	$resultado = consultas::get_datos($sql);
//echo $resultado[0]['resul'];
	if ($resultado[0]['resul']!= null) {
		$loc = explode("*",$resultado[0]['resul']);
		$_SESSION['mensaje']=$loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje']="Error".$sql;
		header("location:cargo_index.php");
	}

 ?>