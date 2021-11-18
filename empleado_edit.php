<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Empleado</title>
		<link rel="icon" type="favicon" href="img/empleado.png"/>
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
	                            <div class="box box-warning">
	                                <div class="box-header"><!--inicio header-->
	                                    <i class="ion ion-android-person ion-edit"></i>
	                                    <h3 class="box-title">Editar Empleado</h3>
	                                    <div class="box-tools">
	                                    	<a href="empleado_index.php" class="btn btn-warning pull-right"> <i class="fa fa-arrow-left" data-title="Volver" rel="tooltip" ></i></a>
	                                    </div>
	                                </div><!--fin header-->
									<form action="empleado_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
										<div class="box-body">
                                            <?php $resultado=consultas::get_datos("select * from v_empleado where emp_cod=".$_GET['vemp_cod']); ?>
                                        <input type="hidden" name="vemp_cod" value="<?php echo $resultado[0]['emp_cod']; ?>" />
                                        <input type="hidden" name="accion" value="2" /><!--Bandera-->
                                        <div class="form-group"> 
                                            <label class="control-label col-lg-2">Cargo:</label>
                                            <div class="col-lg-6">
                                                <!-- AGREGAR LISTA DESPLEGABLE CARGO -->
                                                    
                                                        <div class="input-group col-lg-6">
                                                            <?php $cargo = consultas::get_datos("select * from cargo order by car_cod");
                                                                  
                                                            ?>
                                                            <select class="form-control" name="vcar_cod" required>
                                                                <option value="<?php echo $resultado[0]['car_cod']; ?>"><?php echo $resultado[0]['car_cod']."-".$resultado[0]['car_descri']; ?></option>
                                                                <?php foreach ($cargo as $c) { ?>
                                                                  <option value="<?php echo $c['car_cod'];?>"><?php echo $c['car_cod']."-".$c['car_descri'];?></option>   
                                                                <?php }?>
                                                            </select>  
                                                            <span class="input-group-btn btn-flat">
                                                                <a class="btn btn-primary" data-title ="Agregar Cargo" rel="tooltip" data-placement="top"
                                                                   data-toggle="modal" data-target="#registrar">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                <!-- FIN LISTA DESPLEGABLE CARGO -->
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vemp_nombre" class="form-control" required="" value="<?php echo $resultado[0]['emp_nombre']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vemp_apellido" class="form-control" required="" value="<?php echo $resultado[0]['emp_apellido']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Direccion</label>
                                            <div class="col-lg-4">
                                                <textarea type="text" name="vemp_direcc" class="form-control" value=""><?php echo $resultado[0]['emp_direcc']; ?></textarea>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Telefono</label>
                                            <div class="col-lg-6">
                                                <input type ="number" class="form-control" name="vemp_tel" value="<?php echo $resultado[0]['emp_tel']; ?>"/>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">
                                            <i class="fa fa-remove"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-warning pull-right">
                                            <i class="fa fa-edit"></i>Modificar
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


