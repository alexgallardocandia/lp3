<?php

require 'clases/conexion.php';

session_start();

$sql = "select sp_detalle_orden(
".$_REQUEST['accion'].",
".$_REQUEST['vorden_cod'].",
".$_REQUEST['vdep_cod'].",split_part('".$_REQUEST['vart_cod']."','_',1)::integer,
".(!empty($_REQUEST['vorden_cant'])?$_REQUEST['vorden_cant']:"0").",
".(!empty($_REQUEST['vorden_precio'])?$_REQUEST['vorden_precio']:"0").") as resul";

//echo $sql;

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:compras_det.php?vorden_cod=".$_REQUEST['vorden_cod']);
}else{
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:compras_det.php?vorden_cod=".$_REQUEST['vorden_cod']);
}
