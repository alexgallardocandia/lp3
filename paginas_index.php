<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pagina.png">
        <title>Paginas</title>
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
                                    <i class="fa fa-file"></i>
                                    <h3 class="box-title">Paginas</h3>
                                    <div class="box-tools">
                                        <a href="paginas_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus" data-title="Agregar" rel="tooltip" data-placement="top"></i></a>
                                        <a target="new" href="paginas_print.php" class="btn btn-default btn-sm"><i class="fa fa-print" data-title="Imprimir" rel="tooltip" data-placement="top"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="paginas_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                                $paginas = consultas::get_datos("select * from v_paginas "
                                                    ."where (pag_cod||trim(upper(pag_nombre))) "
                                                    ."like trim(upper('%".$valor."%')) order by pag_cod");
                                            if (!empty($paginas)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Direccion</th>
                                                                <th>Nombre</th>
                                                                <th>Modulos</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($paginas as $pagina) {?>
                                                                <tr>
                                                                    <td data-title="Direccion"><?php echo $pagina['pag_direc']; ?></td>
                                                                    <td data-title="Nombre"><?php echo $pagina['pag_nombre'] ?></td>
                                                                    <td data-title="Modulos"><?php echo $pagina['mod_cod']."-".$pagina['mod_nombre']; ?></td>
                                                                    <td data-title="Aciones" class="text-center">
                                                                        <a href="paginas_edit.php?vpag_cod=<?php echo $pagina['pag_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <!-- boton borrar -->
                                                                        <a onclick="borrar(<?php echo "'".$pagina['pag_cod']."_".$pagina['pag_nombre']."_".$pagina['mod_cod']."'" ; ?>)"
                                                                           class="btn btn-danger btn-sm" role="button" data-title="Borrar"
                                                                           rel="tooltip" data-placement="top" data-toggle="modal" data-target="#borrar"><span class="glyphicon glyphicon-trash"></span>
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
                                                    No se han registrado paginas...
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

            //Borrar
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href', 'paginas_control.php?vpag_cod='+ dat[0]+'&vpag_nombre='+dat[1]+"&vmod_cod="+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar el pagina <i><b>'+dat[1]+'</b></i>?');
            }
        </script>
    </body>
</html>
