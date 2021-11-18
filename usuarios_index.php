<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/usuarios.png">
        <title>Usuarios</title>
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
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="usuarios_add.php" class="btn btn-primary btn-sm" role="button"><i class="ion ion-plus" data-title="Agregar" rel="tooltip" ></i></a>

                                        <a target="new" href="usuarios_print.php" class="btn btn-default btn-sm"> <i class="fa fa-print" data-title="Imprimir" rel="tooltip" ></i></a>
                                    </div>
                                </div><!--fin header-->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="usuarios_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                                $usuarios = consultas::get_datos("select * from v_usuarios "
                                                    ."where (usu_cod||trim(upper(usu_nick))) "
                                                    ."like trim(upper('%".$valor."%')) order by usu_cod");
                                                
                                            if (!empty($usuarios)) {?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12 tablo-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Usuario</th>
                                                                <th>Cargo</th>
                                                                <th>Empleado</th>
                                                                <th>Grupo</th>
                                                                <th>Sucursal</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($usuarios as $usu) {?>
                                                                <tr>
                                                                    <td data-title="Usuario"><?php echo $usu['usu_nick']; ?></td>
                                                                    <td data-title="Cargo"><?php echo $usu['car_cod']."-".$usu['car_descri']; ?></td>
                                                                    <td data-title="Empleado"><?php echo $usu['emp_cod']."-".$usu['empleado']; ?></td>
                                                                    <td data-title="Grupo"><?php echo $usu['gru_cod']."-".$usu['gru_nombre']; ?></td>
                                                                    <td data-title="Sucursal"><?php echo $usu['id_sucursal']."-".$usu['suc_descri']; ?></td>

                                                                    <td data-title="Aciones" class="text-center">
                                                                        <!--Boton de Editar-->
                                                                        <a href="usuarios_edit.php?vusu_cod=<?php echo $usu['usu_cod']; ?>" class="btn btn-warning btn-sm" role="buttom" data-title="Editar" rel="tooltip">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!--Boton de borrar-->
                                                                        <a onclick="borrar(<?php echo "'".$usu['usu_cod']."_".$usu['usu_nick']."_".$usu['car_cod']."_".$usu['emp_cod']."_".$usu['gru_cod']."_".$usu['id_sucursal']."'" ; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#borrar"><span class="glyphicon glyphicon-trash"></span>
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
                                                    No se han registrado usuarios...
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
                $('#si').attr('href', 'usuarios_control.php?vusu_cod='+ dat[0]+'&vusu_nick='+dat[1]+'&vcar_cod='+dat[2]+'&vemp_cod='+dat[3]+'&vgru_cod='+dat[4]+'&vid_sucursal='+dat[5]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n Desea borrar el usuario <i><b>'+dat[1]+'</b></i>?');
            }
        </script>
<!--FIN SCRIPTS MODALES-->

    </body>
</html>


