<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_pedcompras(".$_REQUEST['accion'].", ".(!empty($_REQUEST['vped_com'])?$_REQUEST['vped_com']:"0").",'".(!empty($_REQUEST['vcom_fecha'])?$_REQUEST['vcom_fecha']:"01-01-2000")."', ".$_SESSION['emp_cod']
.",".$_SESSION['id_sucursal'].") as resul";
//echo $sql;/*
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $loc = explode("*",$resultado[0]['resul']);
    $_SESSION['mensaje'] = $loc[0];
    header("location:".$loc[1]);
} else {
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:pedcompras_index.php");
}
