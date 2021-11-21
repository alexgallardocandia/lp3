<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/tipo.png">
        <title>Tipo</title>
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
                                    <span class="glyphicon g    lyphicon-exclamation-sign"></span>
                                <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje']='';?>
                                </div>
                            <?php } ?>
                            <div class="box box-primary"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                    <h3 class="box-title">Tipo de Impuesto</h3>
                                    <div class="box-tools">
                                         <!-- boton agregar -->
                                        <a class="btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#registrar"><i class="ion ion-plus" data-title="Agregar" rel="tooltip" ></i></a>

                                        <a target="new" href="tipo_print.php" class="btn btn-default btn-sm"><i class="fa fa-print" data-title="Imprimir" rel="tooltip" data-placement="top"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="tipo_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                                $tipos = consultas::get_datos("select * from tipo_impuesto "
                                                    ."where (tipo_cod||trim(upper(tipo_descri))) "
                                                    ."like trim(upper('%".$valor."%')) order by tipo_cod");
                                            if (!empty($tipos)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Tipo de Impuesto</th>
                                                                <th>Porcentaje</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($tipos as $tipo) {?>
                                                                <tr>
                                                                    <td data-title="Tipo de Impuesto"><?php echo $tipo['tipo_descri']; ?></td>
                                                                    <td data-title="Porcentaje"><?php echo $tipo['tipo_porcen']; ?></td>
                                                                    <td data-title="Aciones" class="text-center">
                                                                        <!-- boton editar -->
                                                                        <a onclick="editar(<?php echo "'". $tipo['tipo_cod']."_".$tipo['tipo_descri']."_".$tipo['tipo_porcen']."'";?>)" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#editar"><span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <!-- boton borrar -->
                                                                        <a onclick="borrar(<?php echo "'".$tipo['tipo_cod']."_".$tipo['tipo_descri']."'" ; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#borrar"><span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado impuestos...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN FILA-->
                </div>
                <!--FIN CONTENEDOR-->

            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
<!--FORMULARIO MODAL AGREGAR-->
            <div class="modal fade" id="registrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><b>AGREGAR IMPUESTO</b></h4>
                        </div>
                        <form action="tipo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input type="hidden" name="accion" value="1"/>
                            <input type="hidden" name="vtipo_cod" value="0"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">DESCRIPCIÓN</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="vtipo_descri" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">PORCENTAJE</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" pattern="^[0-9]+" name="vtipo_porcen" class="form-control" required />
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
<!--FORMULARIO MODAL EDITAR-->
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><b>EDITAR IMPUESTO</b></h4>
                        </div>
                        <form action="tipo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input type="hidden" name="accion" value="2"/>
                            <input id="cod" type="hidden" name="vtipo_cod"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">DESCRIPCIÓN</label>
                                    <div class="col-sm-10">
                                        <input id="descri" type="text" name="vtipo_descri" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">PORCENTAJE</label>
                                    <div class="col-sm-10">
                                        <input id="porcen" type="number" min="0" pattern="^[0-9]+" name="vtipo_porcen" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right">Modificar</button>
                            </div>
                        </form>
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

        </div>
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
        //EDITAR
            function editar(datos){
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#porcen').val(dat[2]);
                $('#descri').val(dat[1]);
            }
        //Borrar
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href', 'tipo_control.php?vtipo_cod='+ dat[0]+'&vtipo_descri='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar el impuesto <i><b>'+dat[1]+'</b></i>?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->
    </body>
</html>
