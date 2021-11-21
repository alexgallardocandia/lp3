<?php
	require 'clases/conexion.php';

	session_start();

	$sql = "select sp_paginas(".$_REQUEST['accion'].", ".$_REQUEST['vpag_cod'].", '".(!empty($_REQUEST['vpag_direc'])?$_REQUEST['vpag_direc']:"0")."', '".$_REQUEST['vpag_nombre']."', ".(!empty($_REQUEST['vmod_cod'])?$_REQUEST['vmod_cod']:"0").") as resul";
	//echo $sql;/*
	$dato = consultas::get_datos($sql);
	//echo $dato[0]['resul'];
	if ($dato != null) {
	  $loc = explode("*",$dato[0]['resul']);
		$_SESSION['mensaje'] = $loc[0];
		header("location:".$loc[1]);
	}else{
		$_SESSION['mensaje'] = "Error: ".$sql;
		header("location:paginas_index.php");
	}

 ?>
