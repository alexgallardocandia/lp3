<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/modulo.png">
        <title>Eliminar Modulo</title>
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
                            <div class="box box-danger"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Modulo</h3>
                                    <div class="box-tools">
                                        <a href="modulo_index.php" class="btn btn-danger pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div><!--fin header-->
                                <form action="modulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado=consultas::get_datos("select * from modulos where mod_cod =".$_GET['vmod_cod'])?>
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                            <input type="hidden" name="accion" value="3"/><!--bandera-->
                                            <input type="hidden" name="vmod_cod" value="<?php echo $resultado[0]['mod_cod']?>"/>
                                            <input type="text" name="vmod_nombre" class="form-control" value="<?php echo $resultado[0]['mod_nombre'];?>" disabled>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-danger pull-right">
                                            <i class="ion ion-trash-b"> Borrar</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>                        
                    </div>
                    <!--FIN FILA-->
                </div>
                <!--FIN CONTENEDOR-->
             
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


