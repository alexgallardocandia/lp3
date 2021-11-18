<?php
session_start();/*Reanudar sesion*/
if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pedvent.png">
        <title>Pedido de Compras</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php        
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
                                    <i class="fa fa-credit-card"></i>
                                    <h3 class="box-title">Pedido de Compras</h3>
                                    <div class="box-tools">
                                        <a href="pedcompras_add.php" class="btn btn-primary btn-sm" role="button"><i class="ion ion-plus" data-title="Agregar" rel="tooltip" ></i></a>

                                       <!-- <a target="new" href="articulo_print.php" class="btn btn-default btn-sm"> <i class="fa fa-print" data-title="Imprimir" rel="tooltip" ></i></a>-->
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="pedcompras_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" name="buscar" class="form-control" placeholder="Buscar..." autofocus/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip"><span class="fa fa-search"></span></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php 
                                                $valor='';
                                                if (isset($_REQUEST['buscar'])) {
                                                    $valor=$_REQUEST['buscar'];
                                                }
                                                $pedidos = consultas::get_datos("select * from v_pedido_cabcompra "
                                                    ."where (ped_com||trim(upper(prv_razonsocial))) "
                                                    ."like trim(upper('%".$valor."%')) order by ped_com");

                                            if (!empty($pedidos)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Fecha</th>
                                                                <th>Proveedor</th>
                                                                <th>Total</th>
                                                                <th>Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pedidos as $ped) {?>
                                                                <tr>
                                                                    <td data-title="Codigo"><?php echo $ped['ped_com']; ?></td>
                                                                    <td data-title="Fecha"><?php echo $ped['com_fecha']; ?></td>
                                                                    <td data-title="Proveedor"><?php echo $ped['prv_razonsocial']; ?></td>
                                                                    <td data-title="Total"><?php echo number_format($ped['ped_total'], 0, ",", "." ); ?></td>
                                                                    <td data-title="Estado"><?php echo $ped['estado']; ?></td>

                                                                    <td class="text-center">
                                                                        <?php if($ped['estado']=='PENDIENTE') { ?>
                                                                            <!--detalle-->
                                                                            <a href="pedcompras_det.php?vped_com=<?php echo $ped['ped_com']; ?>" class="btn btn-success btn-sm" role="button" data-title="Detalles" rel="tooltip" data-placement="top">
                                                                                <i class="fa fa-list"></i>
                                                                            </a>
                                                                            <!--Editar-->
                                                                            <a href="pedcompras_edit.php?vped_com=<?php echo $ped['ped_com']; ?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!--anular-->
                                                                            <a onclick="anular(<?php echo "'".$ped['ped_com']."_".$ped['prv_razonsocial']."_".$ped['com_fecha']."'"?>)" class="btn btn-danger btn-sm"  
                                                                               data-title='Anular' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#anular">
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                            </a>
                                                                        <?php }?>
                                                                            <!--Imprimir-->
                                                                            <a target="new" href="/lp3/pedcompras_print.php?vped_com=<?php echo $ped['ped_com']; ?>" class="btn btn-primary btn-sm" role="button" target="print" data-title="Imprimir" rel="tooltip" data-placement="top">
                                                                                <i class="fa fa-print"></i>
                                                                            </a>
                                                                       
                                                                    </td>
                                                                </tr>
                                                            <?php }; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado pedidos...
                                                </div>
                                            <?php }; ?>
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
<!--FORMULARIO MODAL BORRAR-->                  
            <div class="modal fade" id="anular" role="dialog">
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
            function anular(datos){
                var dat = datos.split('_');
                $('#si').attr('href','pedcompras_control.php?vped_com='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea anular el \n\
                pedido N° <strong>'+dat[0]+'</strong> de fecha <strong>'+dat[2]+'</strong> del cliente <strong>'+dat[1]+'</strong> ?');
            };
        </script>
<!--FIN SCRIPTS MODALES-->

    </body>
</html>


