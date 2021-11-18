<?php 
	require 'clases/conexion.php';

	session_start();

	$sql = "select sp_empleado(".$_REQUEST['accion'].",".$_REQUEST['vemp_cod'].",".(!empty($_REQUEST['vcar_cod'] )?$_REQUEST['vcar_cod']:"0").",'".$_REQUEST['vemp_nombre']."', '".$_REQUEST['vemp_apellido']."','".(!empty($_REQUEST['vemp_direcc'])?$_REQUEST['vemp_direcc']:"0")."', '".(!empty($_REQUEST['vemp_tel'])?$_REQUEST['vemp_tel']:"0")."') as resul;";
//	echo $sql;
	$resultado = consultas::get_datos($sql);
//	echo $resultado[0]['resul'];

	if ($resultado[0]['resul']!= null) {
		$_SESSION['mensaje']=$resultado[0]['resul'];
		header("location:empleado_index.php");
	}else{
		$_SESSION['mensaje']="Error".$sql;
		header("location:empleado_index.php");
	}

 ?>