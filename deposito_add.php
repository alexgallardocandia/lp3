<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/deposito.png">
        <title>Agregar Deposito</title>
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
                                    <h3 class="box-title">Agregar Deposito</h3>
                                    <div class="box-tools">
                                        <a href="deposito_index.php" data-title="Volver" rel="tooltip" data-placement="top" class="btn btn-primary pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <form action="deposito_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="1"/><!--bandera-->
                                            <input type="hidden" name="vdep_cod" value="0">
                                            <label class="col-lg-1 control-label">Descripcion</label> 
                                            <div class="col-lg-8">
                                                <input type="text" name="vdep_descri" class="form-control" required autofocus />
                                            </div>   
                                        </div>      
                                        <div class="form-group">
                                            <label class="col-lg-1 control-label">Sucursal</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group">
                                                    <select name="vid_sucursal" class="form-control" required="">
                                                    <option value="" selected>Seleccione...</option>                                              
                                                  <?php
                                                    $sucu= consultas::get_datos("select * from sucursal");
                                                    foreach ($sucu as $valor){?> 
                                                    <option value="<?php echo $valor['id_sucursal']; ?>"><?php echo $valor['id_sucursal']."-".$valor['suc_descri']; ?></option>
                                                <?php } ?>
                                                </select>
                                                <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Sucursal" rel="tooltip" data-placement="top"
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
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Sucursal</strong></h4>
                              </div>
                              <form action="sucursal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
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
                  <!--FIN MODAL REGISTRAR-->                    
        </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <!--FORMULARIO MODAL BORRAR-->                  
            <div class="modal fade" id="borrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><b>ATENCIÓN</b></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" id="confirmacion"></div>    
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                </div>
            </div>
<!--FIN FORMULARIO MODAL BORRAR-->
<!--SCRIPTS MODALES-->
    
        <script>
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('input:text:visible:first').focus();
            });
        //Borrar
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href', 'articulo_control.php?vart_cod='+ dat[0]+'&vart_codbarra='+dat[1]+'&vmar_cod='+dat[2]+'&vart_descri='+dat[3]+'&vart_precioc='+dat[4]+'&vart_preciov='+dat[5]+'&vtipo_cod='+dat[6]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar el articulo <i><b>'+dat[1]+'</b></i>?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->
    </body>
</html>


