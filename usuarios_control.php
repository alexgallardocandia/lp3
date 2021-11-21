<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_usuarios(" . $_REQUEST['accion'] .",".$_REQUEST['vusu_cod'].",'" .
        (!empty($_REQUEST['vusu_nick'])?$_REQUEST['vusu_nick']:"0"). "','" .
        (!empty($_REQUEST['vusu_clave'])?$_REQUEST['vusu_clave']:"0"). "', " .
        $_REQUEST['vemp_cod'] . ", " .
        (!empty($_REQUEST['vgru_cod'])?$_REQUEST['vgru_cod']:"0"). ", " .
        (!empty($_REQUEST['vid_sucursal'])?$_REQUEST['vid_sucursal']:"0") .") as resul";
//echo $sql;/*
$resultado = consultas::get_datos($sql);
//echo $resultado[0]['resul'];

if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:usuarios_index.php");
} else {
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:usuarios_index.php");
}
