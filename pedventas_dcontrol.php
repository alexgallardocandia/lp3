<?php
require 'clases/conexion.php';
session_start();

$sql = "select sp_detalle_pedventa(".$_REQUEST['accion'].", "
        .(!empty($_REQUEST['vped_cod'])?$_REQUEST['vped_cod']:"0").", "
        .(!empty($_REQUEST['vdep_cod'])?$_REQUEST['vdep_cod']:"0").", "
        .(!empty($_REQUEST['vart_cod'])? "split_part('".$_REQUEST['vart_cod']."','_',1)::integer":"0").", "
        .(!empty($_REQUEST['vped_cant'])?$_REQUEST['vped_cant']:"0").", "
        .(!empty($_REQUEST['vped_precio'])?$_REQUEST['vped_precio']:"0").") as resul";

//echo $sql;/*
$resultado = consultas::get_datos($sql);
//echo $resultado[0]['resul'];
if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:pedventas_det.php?vped_cod=".$_REQUEST['vped_cod']);
}else{
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:pedventas_det.php?vped_cod=".$_REQUEST['vped_cod']);
}
