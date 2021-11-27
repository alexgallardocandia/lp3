<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pedvent.png">
        <title>Agregar Pedidos</title>
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
                            <div class="box box-primary"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Pedidos</h3>
                                    <div class="box-tools">
                                        <a href="pedventas_index.php" class="btn btn-primary btn-sm" role="button"><i class="fa fa-arrow-left" data-title="Volver" rel="tooltip" ></i></a>

                                       <!-- <a target="new" href="articulo_print.php" class="btn btn-default btn-sm"> <i class="fa fa-print" data-title="Imprimir" rel="tooltip" ></i></a>-->
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="pedventas_control.php" method="get" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="accion" value="1"/>
                                                    <input type="hidden" name="vped_cod" value="0"/>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <?php $fecha = consultas::get_datos("select current_date as fecha"); ?>
                                                            <label>Fecha:</label>
                                                            <input type="date" name="vped_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha']; ?>" readonly=""/>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label>Clientes:</label>
                                                            <div class="input-group">
                                                                <?php $clientes= consultas::get_datos("select * from clientes order by (cli_nombre||' '||cli_apellido) asc"); ?>
                                                                <select class="form-control select2" name="vcli_cod" required="">
                                                                    <?php if(!empty($clientes)) {
                                                                      foreach ($clientes as $cli) { ?>
                                                                        <option value="<?php echo $cli['cli_cod']; ?>"><?php echo $cli['cli_nombre']." ".$cli['cli_apellido']; ?></option>
                                                                    <?php }
                                                                    }else{ ?>
                                                                        <option value="">Debe insertar al menos un cliente</option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-primary btn-flat" type="button" data-toggle = "modal" data-target="#registrar">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label class="">Empleado:</label>
                                                            <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'] ?>" disabled/>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label>Sucursal:</label>
                                                            <input type="text" class="form-control" value="<?php echo $_SESSION['sucursal'] ?>" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <span class="glyphicon glyphicon-floppy-disk"></span> Registrar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN FILA-->
                </div>
            </div>
            <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
        </div>

                <!--FIN CONTENEDOR-->
<!--FORMULARIO MODAL AGREGAR-->
            <div class="modal fade" id="registrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><b>AGREGAR CLIENTE</b></h4>
                        </div>
                        <form action="clientes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="box-body">
                                <input type="hidden" name="vcli_cod" value="0" />
                                <input type="hidden" name="accion" value="4" /><!--Bandera-->
                                <div class="form-group">
                                    <label class="control-label col-lg-2">C.I. N°</label>
                                    <div class="col-lg-4">
                                        <input type="number"  name="vcli_ci" class="form-control" required="" autofocus="" min="1" pattern="^[0-9]+" placeholder="Ingrese el CI del cliente">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Nombres</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="vcli_nombre" class="form-control" required="" placeholder="Ingrese el Nombre del cliente"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Apellidos</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="vcli_apellido" class="form-control" required="" placeholder="Ingrese el apellido del cliente"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Telefono</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="vcli_telefono" class="form-control" required placeholder="Ingrese el telefono del cliente">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Dirección</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" name="vcli_direcc" required placeholder="Ingrese la dirección del cliente"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default">
                                    <i class="fa fa-remove"></i>Cerrar
                                </button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-floppy-o"></i>Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--FIN FORMULARIO MODAL AGREGAR-->
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

        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200, function(){
                $(this).alert('close');
            });
        </script>
<!--SCRIPTS MODALES-->

        <script>
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('input:text:visible:first').focus();
            });
        //Borrar
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href', 'articulo_control.php?vart_cod='+dat[0]+'&vart_descri='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar el articulo con codigo <i><b>'+dat[0]+'</b></i>?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->

    </body>
</html>
