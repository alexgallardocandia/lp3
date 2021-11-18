<?php 
	require 'clases/conexion.php';
	session_start();

	$sql = "select sp_marca(".$_REQUEST['accion'].",".$_REQUEST['vmar_cod'].",'".$_REQUEST['vmar_descri']."') as resul;";
	//echo $sql;	
	$resultado = consultas::get_datos($sql);
	//echo $resultado[0]['resul'];

	if ($resultado[0]['resul']!= null) {
		$loc=explode("*", $resultado[0]['resul']);
		$_SESSION['mensaje']=$loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje']="Error".$sql;
		header("location:marca_index.php");
	}
/*
	switch ($_REQUEST['accion']) {
		case 1:
			$sql = "insert into marca(mar_cod, mar_descri) "
			."values((select coalesce(max(mar_cod),0)+1 from marca),'".$_REQUEST['vmar_descri']."')";
			$mensaje='Guardado Exitosamente';
		break;
		case 2:
			$sql="update marca set mar_descri ='".$_REQUEST['vmar_descri']."' where mar_cod=".$_REQUEST['vmar_cod'];
			$mensaje='Modificado Exitosamente';
		break;
		case 3:
			$sql="delete from marca where mar_cod=".$_REQUEST['vmar_cod'];
			$mensaje='Borrado Exitosamente';
		break;
	}
	
	if (consultas::ejecutar_sql($sql)) {
		$_SESSION['mensaje']=$mensaje;
		header("location:marca_index.php");
	}else{
		$_SESSION['mensaje']='Error '. $sql;
		header("location:marca_index.php");
	}
*/

 ?>