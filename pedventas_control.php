<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_pedventas(".$_REQUEST['accion'].", ".(!empty($_REQUEST['vped_cod'])?$_REQUEST['vped_cod']:"0").", ".$_SESSION['emp_cod'].", ".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").", ".$_SESSION['id_sucursal'].") as resul";
//echo $sql;/*
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:pedventas_index.php");
} else {
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:pedventas_index.php");
}