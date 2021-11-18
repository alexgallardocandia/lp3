<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/usuarios.png">
        <title>Editar Usuario</title>
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
                            <div class="box box-warning"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Editar Usuario</h3>
                                    <div class="box-tools">
                                        <a href="usuarios_index.php" class="btn btn-warning pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div><!--fin header-->
                                <form action="usuarios_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <?php  $e=consultas::get_datos("select * from v_usuarios where usu_cod=".$_GET['vusu_cod']) ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="2"/>
                                            <input type="hidden" name="vusu_cod" value="<?php echo $e[0]['usu_cod']; ?>"/>                                            
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Usuario</label>
                                            <div class="col-lg-4 col-md-5 col-sm-5">
                                                <input placeholder="Usuario" type="text" name="vusu_nick" class="form-control" value= "<?php echo $e[0]['usu_nick']; ?>" autofocus=""/>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Clave</label>
                                            <div class="col-lg-4 col-md-5 col-sm-5">
                                                <input placeholder="Ingrese su clave" type="password" name="vusu_clave" class="form-control" required="" autofocus=""/>
                                            </div>
                                        </div>-->
                                        <!-- AGREGAR LISTA DESPLEGABLE CARGO-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Cargo</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <?php $cargos = consultas::get_datos("select * from cargo order by car_descri");?>
                                                    <select class="form-control select2" name="vcar_cod" required="">
                                                        <option value="<?php echo $e[0]['car_cod']; ?>"><?php echo $e[0]['car_descri']; ?></option>
                                                        <?php foreach ($cargos as $c) { ?>
                                                          <option value="<?php echo $c['car_cod'];?>"><?php echo $c['car_descri'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Cargo " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrarc">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE CARGO -->
                                        <!-- AGREGAR LISTA DESPLEGABLE EMPLEADO-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Empleado</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <?php $emp = consultas::get_datos("select * from v_empleado order by emp_cod");?>
                                                    <select class="form-control select2" name="vemp_cod" required="">
                                                        <option value="<?php echo $e[0]['emp_cod']; ?>"><?php echo $e[0]['empleado']; ?></option>
                                                        <?php foreach ($emp as $em) { ?>
                                                          <option value="<?php echo $em['emp_cod'];?>"><?php echo $em['emp_nombre'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE EMPLEADO -->
                                        <!-- AGREGAR LISTA DESPLEGABLE GRUPOS-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Grupo</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <?php $gru = consultas::get_datos("select * from grupos order by gru_cod");?>
                                                    <select class="form-control select2" name="vgru_cod" required="">
                                                        <option value="<?php echo $e[0]['gru_cod']; ?>"><?php echo $e[0]['gru_nombre']; ?></option>
                                                        <?php foreach ($gru as $g) { ?>
                                                          <option value="<?php echo $g['gru_cod'];?>"><?php echo $g['gru_nombre'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Grupo " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrarg">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE GRUPOS -->
                                        <!-- AGREGAR LISTA DESPLEGABLE GRUPOS-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sucursal</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <?php $sucu = consultas::get_datos("select * from sucursal order by id_sucursal");?>
                                                    <select class="form-control select2" name="vid_sucursal" required="">
                                                        <option value="<?php echo $e[0]['id_sucursal']; ?>"><?php echo $e[0]['suc_descri']; ?></option>
                                                        <?php foreach ($sucu as $s) { ?>
                                                          <option value="<?php echo $s['id_sucursal'];?>"><?php echo $s['suc_descri'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Sucursal " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrars">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE GRUPOS -->
                                    </div>
                                    <div class="box-footer">
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
    </body>
</html>


