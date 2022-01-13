<?php
require 'clases/conexion.php';
session_start();

$sql = "select sp_detalle_transferencia(".$_REQUEST['accion'].", "
        .(!empty($_REQUEST['vtrans_cod'])?$_REQUEST['vtrans_cod']:"0").", "
        .(!empty($_REQUEST['vdep_cod'])?$_REQUEST['vdep_cod']:"0").", "
        .(!empty($_REQUEST['vart_cod'])?$_REQUEST['vart_cod']:"0").", "
        .(!empty($_REQUEST['vtrans_cant'])?$_REQUEST['vtrans_cant']:"0").", "
        .(!empty($_REQUEST['vdep_cod_destino'])?$_REQUEST['vdep_cod_destino']:"0").") as resul";

//echo $sql;/*
$resultado = consultas::get_datos($sql);
//echo $resultado[0]['resul'];
if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:transferir_det.php?vtrans_cod=".$_REQUEST['vtrans_cod']);
}else{
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:transferir_det.php?vtrans_cod=".$_REQUEST['vtrans_cod']);
}
