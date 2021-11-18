<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/usuarios.png">
        <title>Agregar Usuario</title>
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
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="usuarios_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="usuarios_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="1"/>
                                            <input type="hidden" name="vusu_cod" value="0"/>                                            
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Usuario</label>
                                            <div class="col-lg-4 col-md-5 col-sm-5">
                                                <input placeholder="Usuario" type="text" name="vusu_nick" class="form-control" required="" autofocus=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Clave</label>
                                            <div class="col-lg-4 col-md-5 col-sm-5">
                                                <input placeholder="Ingrese su clave" type="password" name="vusu_clave" class="form-control" required="" autofocus=""/>
                                            </div>
                                        </div>
                                        <!-- AGREGAR LISTA DESPLEGABLE CARGO-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Cargo</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <?php $cargos = consultas::get_datos("select * from cargo order by car_descri");?>
                                                    <select class="form-control select2" name="vcar_cod" required="">
                                                        <option value="">Seleccione un cargo</option>
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
                                                        <option value="">Seleccione un empleado</option>
                                                        <?php foreach ($emp as $e) { ?>
                                                          <option value="<?php echo $e['emp_cod'];?>"><?php echo $e['emp_nombre'];?></option>   
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
                                                        <option value="">Seleccione un grupo</option>
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
                                                        <option value="">Seleccione una sucursal</option>
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
                                        <button type="reset" class="btn btn-default" data-title="Cancelar" rel="tooltip"> 
                                            <i class="fa fa-remove"></i> Cancelar</button>                                        
                                        <button type="submit" class="btn btn-primary pull-right" data-title="Guardar" rel="tooltip"> 
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                  <!-- MODAL REGISTRARC -->
                  <div class="modal fade" id="registrarc" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Cargo</strong></h4>
                              </div>
                              <form action="cargo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="5">
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
                  <!--FIN MODAL REGISTRARC-->

                  <!-- MODAL REGISTRARG -->
                  <div class="modal fade" id="registrarg" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Grupo</strong></h4>
                              </div>
                              <form action="grupo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vgru_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Descripción:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vgru_nombre" class="form-control" required="" autofocus=""/>
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
                  <!--FIN MODAL REGISTRARG -->

                  <!-- MODAL REGISTRARS -->
                  <div class="modal fade" id="registrars" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Sucursal</strong></h4>
                              </div>
                              <form action="sucursal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="5">
                                  <input type="hidden" name="vid_sucursal" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Descripción:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vsuc_descri" class="form-control" required="" autofocus=""/>
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
                  <!--FIN MODAL REGISTRARS -->

        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>