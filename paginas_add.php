<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pagina.png">
        <title>Agregar Paginas</title>
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
                            <div class="box box-primary"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Pagina</h3>
                                    <div class="box-tools">
                                        <a href="paginas_index.php" data-title="Volver" rel="tooltip" data-placement="top" class="btn btn-primary pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <form action="paginas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="1"/><!--bandera-->
                                            <input type="hidden" name="vpag_cod" value="0">
                                            <label class="col-lg-1 control-label">Direccion</label> 
                                            <div class="col-lg-8">
                                                <input type="text" name="vpag_direc" class="form-control" required autofocus />
                                            </div>   
                                        </div>
                                        <div class="form-group">
                                            
                                            <label class="col-lg-1 control-label">Nombre</label> 
                                            <div class="col-lg-8">
                                                <input type="text" name="vpag_nombre" class="form-control" required autofocus />
                                            </div>   
                                        </div>      
                                        <div class="form-group">
                                            <label class="col-lg-1 control-label">Modulos</label>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                                                <div class="input-group">
                                                    <select name="vmod_cod" class="form-control" required>
                                                    <option value="" selected>Seleccione...</option>                                              
                                                  <?php
                                                    $modu= consultas::get_datos("select * from modulos");
                                                    foreach ($modu as $valor){?> 
                                                    <option value="<?php echo $valor['mod_cod']; ?>"><?php echo $valor['mod_cod']."-".$valor['mod_nombre']; ?></option>
                                                <?php } ?>
                                                </select>
                                                <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Marca " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="fa fa-floppy-o btn btn-primary pull-right"> Registrar</button>
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
<!-- MODAL REGISTRAR -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Modulo</strong></h4>
                              </div>
                              <form action="modulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vmod_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Descripción:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vmod_nombre" class="form-control" required="" autofocus=""/>
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


