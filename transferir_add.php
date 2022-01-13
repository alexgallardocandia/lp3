<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/índice.png">
        <title>SIGTALLER</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php
        session_start();/*Reanudar sesion*/
        if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->
        <style type="text/css">
            .small-box{
                background-color: #202020;
                width: 240px;
                height: 120px;
            }
        </style>
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
                          <i class="fa fa-plus"></i>
                          <h3 class="box-title">Agregar Transferencia</h3>
                          <div class="box-tools">
                            <a href="transferir_index.php" class="btn btn-primary btn-sm" role="button"><i class="fa fa-arrow-left" data-title="Agregar" rel="tooltip" ></i></a>
                          </div>
                        </div>
                        <div class="box-body no-padding">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <form class="form-horizontal" action="transferir_control.php" accept-charset="utf-8" method="post">
                                <div class="box-body">
                                    <input type="hidden" name="accion" value="1"/>
                                    <input type="hidden" name="vtrans_cod" value="0"/>
                                    <div class="row">
                                      <div class="form-group col-xs-12">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-2">Sucursal Origen:</label>
                                            <div class="col-lg-6 col-xs-6">
                                              <input type="text" class="form-control" value="<?php echo $_SESSION['sucursal'] ?>" disabled/>
                                              <input type="hidden" name="vid_sucursal_origen" value="<?php echo $_SESSION['id_sucursal'] ?>"/>
                                            </div>
                                      </div>
                                      <div class="form-group col-xs-12">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-2">Sucursal Destino:</label>
                                            <div class="col-lg-6 col-xs-6">
                                                  <?php $sucursal= consultas::get_datos("select * from sucursal where id_sucursal <>".
                                                  $_SESSION['id_sucursal']." order by suc_descri asc"); ?>
                                                  <select class="form-control select2" name="vid_sucursal_destino" required="">
                                                      <?php if(!empty($sucursal)) {
                                                        foreach ($sucursal as $suc) { ?>
                                                          <option value="<?php echo $suc['id_sucursal']; ?>"><?php echo $suc['suc_descri']; ?></option>
                                                      <?php }
                                                      }else{ ?>
                                                          <option value="">Debe insertar al menos una sucursal</option>
                                                      <?php } ?>
                                                  </select>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                          <?php $fecha = consultas::get_datos("select current_date as fecha"); ?>
                                          <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-2">Fecha:</label>
                                          <div class="col-lg-6 col-xs-6">
                                            <input type="date" name="vtrans_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha']; ?>" class="form-control" readonly   />
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                                    </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
        </div>
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>
