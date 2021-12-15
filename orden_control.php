<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_orden(".$_REQUEST['accion'].",
".$_REQUEST['vorden_cod'].",
".$_SESSION['emp_cod'].",
".(!empty($_REQUEST['vprv_cod'])?$_REQUEST['vprv_cod']:"0").",'
".(!empty($_REQUEST['vorden_fecha'])?$_REQUEST['vorden_fecha']:"01-01-2000")."',
".$_SESSION['id_sucursal'].",".(!empty($_REQUEST['vped_com'])?$_REQUEST['vped_com']:"0").") as resul";
//echo $sql;/*
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje'] ="Error:".$sql;
    header("location:compras_index.php");
}
