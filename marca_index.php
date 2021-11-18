<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/Copyright.png">
        <title>Marcas</title>
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
                                    <i class="fa fa-registered"></i>
                                    <h3 class="box-title">Marcas</h3>
                                    <div class="box-tools">
                                        <!-- boton agregar -->
                                        <a class="btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#registrar"><i class="ion ion-plus" data-title="Agregar" rel="tooltip" ></i></a>

                                        <a target="new" href="marca_print.php" class="btn btn-default btn-sm"><i class="fa fa-print" data-title="Imprimir" rel="tooltip" data-placement="top"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="marca_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                                $marcas = consultas::get_datos("select * from marca "
                                                    ."where (mar_cod||trim(upper(mar_descri))) "
                                                    ."like trim(upper('%".$valor."%')) order by mar_cod");
                                            if (!empty($marcas)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Marca</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($marcas as $mar) {?>
                                                                <tr>
                                                                    <td data-title="Descripcion"><?php echo $mar['mar_descri']; ?></td>
                                                                    <td data-title="Aciones" class="text-center">
                                                                        <!-- boton editar -->
                                                                        <a onclick="editar(<?php echo "'". $mar['mar_cod']."_".$mar['mar_descri']."'";?>)" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#editar"><span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <!-- boton borrar -->
                                                                        <a onclick="borrar(<?php echo "'".$mar['mar_cod']."_".$mar['mar_descri']."'" ; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#borrar"><span class="glyphicon glyphicon-trash"></span>
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
                                                    No se han registrado marcas...
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
                            <h4 class="modal-title"><b>AGREGAR MARCA</b></h4>
                        </div>
                        <form action="marca_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input type="hidden" name="accion" value="1"/>
                            <input type="hidden" name="vmar_cod" value="0"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">DESCRIPCIÓN</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="vmar_descri" class="form-control" required />
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
                            <h4 class="modal-title"><b>EDITAR MARCA</b></h4>
                        </div>
                        <form action="marca_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <input type="hidden" name="accion" value="2"/>
                            <input id="cod" type="hidden" name="vmar_cod"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">DESCRIPCIÓN</label>
                                    <div class="col-sm-10">
                                        <input id="descri" type="text" name="vmar_descri" class="form-control" required />
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
                $('#descri').val(dat[1]);
            }
        //Borrar
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href', 'marca_control.php?vmar_cod='+ dat[0]+'&vmar_descri='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar la marca <i><b>'+dat[1]+'</b></i>?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->        
    </body>
</html>


