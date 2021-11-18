<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pedvent.png">
        <title>Editar Pedidos</title>
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
                            <div class="box box-primary">
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Editar Pedidos</h3>
                                    <div class="box-tools">
                                        <a href="pedventas_index.php" class="btn btn-warning btn-sm" role="button"><i class="fa fa-arrow-left" data-title="Volver" rel="tooltip" ></i></a>
                                    </div>
                                </div><!--fin header-->




                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="pedventas_control.php" method="get" accept-charset="utf-8" class="form-horizontal">



                                                <div class="box-body">
                                                    <?php $pedido = consultas::get_datos("select * from v_pedido_cabventa where ped_cod=".$_REQUEST['vped_cod']); ?>
                                                    <input type="hidden" name="accion" value="2" />
                                                    <input type="hidden" name="vped_cod" value="<?php echo $pedido[0]['ped_cod']; ?>" />
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label>Fecha:</label>
                                                            <input type="text" name="vped_fecha" class="form-control" value="<?php echo $pedido[0]['ped_fecha']; ?>" readonly />
                                                        </div>
                                                        <div class="col-xs-12 col-lg-2 col-md-6">
                                                            <label>Clientes:</label>
                                                                <div class="input-group">
                                                                    <?php $clientes = consultas::get_datos("select * from clientes order by cli_cod=".$pedido[0]['cli_cod']." desc"); ?>
                                                                    <select class="form-control select2" name="vcli_cod" required>
                                                                        <?php if(!empty($clientes)) {
                                                                                foreach($clientes as $cliente){ ?>
                                                                                    <option value="<?php echo $cliente['cli_cod']; ?>"><?php echo $cliente['cli_nombre']." ".$cliente['cli_apellido']; ?>
                                                                                    </option>
                                                                                <?php }
                                                                                }else{?>
                                                                                    <option value="">Debe insertar al menos un cliente</option>
                                                                                <?php } ?>
                                                                    </select>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#registrar">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label>Empleado:</label>
                                                            <input type="text" class="form-control" value="<?php echo $pedido[0]['empleado']; ?>" disabled />
                                                        </div>
                                                        <div class="col-xs-12 col-lg-4 col-md-6">
                                                            <label>Sucursal:</label>
                                                            <input type="text" class="form-control" value="<?php echo $pedido[0]['suc_descri']; ?>" disabled />
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-warning pull-right">
                                                        <span class="glyphicon glyphicon-floppy-disk"></span> Actualizar
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
                            <h4 class="modal-title"><b>AGREGAR CARGO</b></h4>
                        </div>
                        <form action="cargo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input type="hidden" name="accion" value="1"/>
                            <input type="hidden" name="vcar_cod" value="0"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">DESCRIPCIÓN</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="vcar_descri" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right">Registrar</button>
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


