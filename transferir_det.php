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
        <title>Agregar Detalle</title>
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
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Detalle de Transferencia</h3>
                                    <div class="box-tools">
                                        <a href="transferir_index.php" class="btn btn-primary btn-sm" role="button"><i class="fa fa-arrow-left" data-title="Volver" rel="tooltip" ></i></a>

                                       <!-- <a target="new" href="articulo_print.php" class="btn btn-default btn-sm"> <i class="fa fa-print" data-title="Imprimir" rel="tooltip" ></i></a>-->
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                            <?php
                                                $transferencias = consultas::get_datos("select * from v_transferencias where trans_cod=".$_REQUEST['vtrans_cod']);

                                            if (!empty($transferencias)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Fecha</th>
                                                                <th>Sucursal O.</th>
                                                                <th>Sucursal Destino</th>
                                                                <th>Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($transferencias as $tra) {?>
                                                                <tr>
                                                                    <td data-title="Codigo"><?php echo $tra['trans_cod']; ?></td>
                                                                    <td data-title="Fecha"><?php echo $tra['trans_fecha']; ?></td>
                                                                    <td data-title="Sucursal Origen"><?php echo $tra['id_sucursal_origen']."-".$tra['suc_descri']; ?></td>
                                                                    <td data-title="Sucursal Destino"><?php echo $tra['id_sucursal_destino']."-".$tra['suc_descri_destino']; ?></td>
                                                                    <td data-title="Estado"><?php echo $tra['trans_estado']; ?></td>
                                                                </tr>
                                                            <?php }; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado transferencias...
                                                </div>
                                            <?php }; ?>
                                        </div>
                                    </div>
                                    <!--FIN PEDIDO CABECERA-->
                                    <!--DETALLE PEDIDO-->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php $detalle=consultas::get_datos("select * from v_detalle_trans where trans_cod=".$tra['trans_cod']);
                                                if(!empty($detalle)){ ?>
                                                    <div class="box-header">
                                                        <i class="fa fa-list"></i>
                                                        <h3 class="box-title">Detalle Items</h3>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-condensed table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Deposito O.</th>
                                                                    <th>Articulo</th>
                                                                    <th>Cantidad</th>
                                                                    <th class="text-center">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($detalle as $d){ ?>
                                                                    <tr>
                                                                        <td data-title="#"><?php echo $d['trans_cod'];?></td>
                                                                        <td data-title="Deposito O."><?php echo $d['dep_cod']." ".$d['dep_descri'];?></td>
                                                                        <td data-title="Articulo"><?php echo $d['art_cod']."-".$d['art_descri'];?></td>
                                                                        <td data-title="Cantidad"><?php echo $d['trans_cant'];?></td>
                                                                        <td class="text-center">
                                                                            <a onclick="editar(<?php echo $d['trans_cod'];?>,<?php echo $d['art_cod'];?>,<?php echo $d['dep_cod'];?>)" class="btn btn-warning btn-sm" role='button'
                                                                               data-title='Editar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#editar">
                                                                                <span class="glyphicon glyphicon-edit"></span>
                                                                            </a>
                                                                            <a onclick="borrar(<?php echo "'".$d['trans_cod']."_".$d['art_cod']."_".$d['dep_cod']."'"?>)" class="btn btn-danger btn-sm" role='button'
                                                                               data-title='Borrar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#borrar">
                                                                                <span class="glyphicon glyphicon-trash"></span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <i class="fa fa-info-circle"></i> En la transferencia aun no se cargaron detalles...
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <!--FIN DETALLE PEDIDO-->
                                    <!--FORMULARIO AGREGAR-->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="transferir_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                <input type="hidden" name="accion" value="1">
                                                <input type="hidden" name="vtrans_cod" value="<?php echo $transferencias[0]['trans_cod'];?>">
                                                <div class="box-body">
                                                    <!--ARTICULO-->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Articulo:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $articulos = consultas::get_datos("select * from v_articulo order by art_descri");?>
                                                            <select class="form-control select2" name="vart_cod" required="" id="articulo" onchange="precio()">
                                                                    <option value="">Seleccione un articulo</option>
                                                                    <?php foreach ($articulos as $articulo) { ?>
                                                                      <option value="<?php echo $articulo['art_cod'];?>"><?php echo $articulo['art_descri']." ".$articulo['mar_descri'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <!--/ARTICULO-->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Cantidad:</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vtrans_cant" min="1" value="1" required=""/>
                                                        </div>
                                                    </div>
                                                    <!--DEPOSITO-->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Deposito Origen:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $depositos = consultas::get_datos("select * from deposito where id_sucursal = ".$tra['id_sucursal_origen']." order by dep_descri");?>
                                                                <select class="form-control select2" name="vdep_cod" required="">
                                                                    <option value="">Seleccione un deposito</option>
                                                                    <?php foreach ($depositos as $deposito) { ?>
                                                                      <option value="<?php echo $deposito['dep_cod'];?>"><?php echo $deposito['dep_descri'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <!--/DEPOSITO-->
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-floppy-o"></i> Agregar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--FIN FORMULARIO AGG-->
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
<!--FORMULARIO MODAL EDITAR-->
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles">

                    </div>
                </div>
            </div>
<!--FIN FORMULARIO MODAL EDITAR-->
<!--FORMULARIO MODAL BORRAR-->
            <div class="modal fade" id="borrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><b>ATENCI??N</b></h4>
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
            function precio(){
            var valor = $('#articulo').val().split('_');
            $('#vprecio').val(valor[1]);
            };
            function editar(ped,art,dep){
                $.ajax({
                    type    : "GET",
                    url     : "/taller/transferir_dedit.php?vtrans_cod="+ped+"&vart_cod="+art+"&vdep_cod="+dep,
                    cache   : false,
                    beforeSend:function(){
                       $("#detalles").html('<img src="img/loader.gif"/><strong>Cargando...</strong>')
                    },
                    success:function(data){
                        $("#detalles").html(data)
                    }
                });
            };
            function borrar(datos){
                var dat = datos.split('_');
                $('#si').attr('href','transferir_dcontrol.php?vtrans_cod='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el articulo \n\
        <strong>'+dat[1]+'</strong> ?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->

    </body>
</html>
