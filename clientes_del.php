<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Clientes</title>
		<link rel="icon" type="favicon" href="img/clientes.png"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
        session_start();/*Reanudar sesion*/
        if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
	                <!--INICIO CONTENEDOR-->
	                <div class="content">
	                    <!--INICIO FILA-->
	                    <div class="row">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                            <?php if (!empty($_SESSION['mensaje'])) {?>
	                                <div class="alert alert-danger" role="alert" id="mensaje">
	                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
	                                <?php echo $_SESSION['mensaje']; 
	                                    $_SESSION['mensaje']='';?>
	                                </div>
	                            <?php } ?>
	                            <div class="box box-danger">
	                                <div class="box-header"><!--inicio header-->
	                                    <i class="ion ion-trash-b"></i>
	                                    <h3 class="box-title">Eliminar Clientes</h3>
	                                    <div class="box-tools">
	                                    	<a href="clientes_index.php" class="btn btn-danger pull-right"> <i class="fa fa-arrow-left" data-title="Volver" rel="tooltip" ></i></a>
	                                    </div>
	                                </div><!--fin header-->
									<form action="clientes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
										<div class="box-body">
											<?php $resultado = consultas::get_datos("select * from clientes where cli_cod=".$_GET['vcli_cod']) ?>
                                        <input type="hidden" name="vcli_cod" value="<?php echo $resultado[0]['cli_cod'] ?>" />
                                        <input type="hidden" name="accion" value="3" /><!--Bandera-->

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">N° C.I.</label>
                                            <div class="col-lg-6">
                                                <input type="number" name="vcli_ci" class="form-control" value="<?php echo $resultado[0]['cli_ci'] ?>" readonly onmousedown="return false;"/>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_nombre" class="form-control" value="<?php echo $resultado[0]['cli_nombre'] ?>" disabled/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_apellido" class="form-control" value="<?php echo $resultado[0]['cli_apellido'] ?>" disabled/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Telefono</label>
                                            <div class="col-lg-4">
                                                <input type="text" name="vcli_telefono" class="form-control" value="<?php echo $resultado[0]['cli_telefono'] ?>" disabled/>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Dirección</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="vcli_direcc" disabled><?php echo $resultado[0]['cli_direcc'] ?></textarea>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-danger pull-right">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </div>  
									</form>   
	                            </div>
	                        </div>                        
	                    </div>
	                    <!--FIN FILA-->
	                </div>
	                <!--FIN CONTENEDOR-->
	        </div>
	                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
        </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200, function(){
                $(this).alert('close');
            });
        </script>
    </body>
</html>


