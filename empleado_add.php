<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/img/empleado.png">
        <title>Agregar Empleado</title>
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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-android-person-add"></i>
                                    <h3 class="box-title">Agregar Empleados</h3>
                                    <div class="box-tools">
                                        <a href="empleado_index.php" class="btn btn-primary pull-rigth btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left">    </i>
                                        </a>
                                    </div>                                    
                                </div>
                                <form action="empleado_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="vemp_cod" value="0" />
                                        <input type="hidden" name="accion" value="1" /><!--Bandera-->
                                        <div class="form-group"> 
                                            <label class="control-label col-lg-2">Cargo:</label>
                                            <div class="col-lg-6">
                                                <!-- AGREGAR LISTA DESPLEGABLE CARGO -->
                                                    
                                                        <div class="input-group col-lg-6">
                                                            
                                                            <select class="form-control select2" name="vcar_cod" required="">
                                                                <option value="" selected="">Seleccione un cargo</option>
                                                                <?php $cargo = consultas::get_datos("select * from cargo");
                                                                foreach ($cargo as $c) { ?>
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
                                                <input type="text" name="vemp_nombre" class="form-control" required="" placeholder="Ingrese el Nombre del Empleado"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vemp_apellido" class="form-control" required="" placeholder="Ingrese el apellido del Empleado"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Direccion</label>
                                            <div class="col-lg-4">
                                                <textarea type="text" name="vemp_direcc" class="form-control" placeholder="Ingrese la direccion del Empleado"></textarea>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Telefono</label>
                                            <div class="col-lg-6">
                                                <input type ="number" class="form-control" name="vemp_tel" placeholder="Ingrese el telefono del Empleado"/>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">
                                            <i class="fa fa-remove"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i>Guardar
                                        </button>
                                    </div>    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
<!-- MODAL REGISTRAR -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Cargo</strong></h4>
                              </div>
                              <form action="cargo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vcar_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Descripción:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vcar_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                          <i class="fa fa-remove"></i> Cerrar</button>
                                          <button type="submit" class="btn btn-primary pull-right">
                                          <i class="fa fa-floppy-o"></i> Registrar</button>                                          
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!--FIN MODAL REGISTRAR-->                  
        </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>

