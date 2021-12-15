<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pedvent.png">
        <title>Agregar Orden</title>
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
                                    <h3 class="box-title">Agregar Orden</h3>
                                    <div class="box-tools">
                                        <a href="orden_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i> VOLVER
                                        </a>
                                    </div>
                                </div>
                                <form action="orden_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vorden_cod" value="0">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php $fecha = consultas::get_datos("select current_date as fecha");?>
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Fecha:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                              <input type="date" name="vorden_fecha" class="form-control" value="<?php echo $fecha[0]['fecha'];?>" class="form-control" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2">Pedido:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <select class="form-control select2 ped" name="vped_cod" required="" id="tipo_pedido" onchange="pedidos()">
                                                    <option value="" selected>Seleccione una opcion</option>
                                                    <option value="SIN">SIN PEDIDO</option>
                                                    <option value="CON">CON PEDIDO</option>
                                                </select>
                                            </div>
                                            <div id="det_pedidos"></div>
                                        </div>

                                        <!-- AGREGAR LISTA DESPLEGABLE Proveedor -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2">Proveedor:</label>
                                            <div class="col-lg-6 col-md-6 col-sm-5">
                                                <div class="input-group">
                                                    <?php $proveedor = consultas::get_datos("select * from proveedor order by prv_razonsocial");?>
                                                    <select class="form-control select2" name="vprv_cod" required="" id="proveedor">
                                                        <option value="">Seleccione un proveedor</option>
                                                        <?php foreach ($proveedor as $prv) { ?>
                                                          <option value="<?php echo $prv['prv_cod'];?>"><?php echo "(".$prv['prv_ruc'].") ".$prv['prv_razonsocial'];?></option>
                                                        <?php }?>
                                                    </select>
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Proveedor " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE MARCA -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Empleado:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'];?>" readonly=""/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Sucursal:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['sucursal'];?>" readonly=""/>
                                            </div>
                                        </div>
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
            </div>
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>

            function tipocompra(){
//                alert($("#tipo_venta").val())
              /*    if ($('#tipo_pedido').val()==='SIN') {
                      $('.tipo').hide();
                       $("#cuotas").val(1);
                      $("#cuotas").prop('readonly',true);
                      $("#intervalo").val(0);
                      $("#intervalo").prop('readonly',true);
                  }else{
                      $('.tipo').show();
                      $("#cuotas").prop('readonly',false);
                      $("#intervalo").prop('readonly',false);
                  }*/
            };
            /*FUNCION PARA OBTENER LOS PEDIDOS
             * DEL CLIENTE SELECCCIONADO*/
            function pedidos(){
              if ($('.ped').val()==='CON') {
                $.ajax({
                   type     : "GET",
                   url      : "/taller/orden_pedidos.php?vped_com="+$('#pedido').val(),
                   cache    : false,
                beforeSend:function(){
                   $("#det_pedidos").html('<img src="img/loader.gif"/><strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#det_pedidos").html(data)
                }
                });
              }else{

              }
            };
        </script>
    </body>
</html>
