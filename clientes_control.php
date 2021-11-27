<?php
	require 'clases/conexion.php';

	session_start();

	$sql = "select sp_clientes(".$_REQUEST['accion'].",".$_REQUEST['vcli_cod'].",".(!empty($_REQUEST['vcli_ci'] )?$_REQUEST['vcli_ci']:"0").",'".$_REQUEST['vcli_nombre']."', '".$_REQUEST['vcli_apellido']."','".(!empty($_REQUEST['vcli_telefono'])?$_REQUEST['vcli_telefono']:"0")."', '".(!empty($_REQUEST['vcli_direcc'])?$_REQUEST['vcli_direcc']:"0")."') as resul;";
	//echo $sql;
	$resultado = consultas::get_datos($sql);
	//echo $resultado[0]['resul'];

	if ($resultado[0]['resul']!= null) {
		$loc = explode("*",$resultado[0]['resul']);
		$_SESSION['mensaje']=$loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje']="Error".$sql;
		header("location:clientes_index.php");
	}

 ?>
