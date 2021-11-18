<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/pagina.png">
        <title>Eliminar Paginas</title>
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
                                    <h3 class="box-title">Borrar Pagina</h3>
                                    <div class="box-tools">
                                        <a href="paginas_index.php"  data-title="Volver" class="btn btn-danger pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div><!--fin header-->
                                <form action="paginas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado=consultas::get_datos("select * from paginas where pag_cod =".$_GET['vpag_cod']);?>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="3"/><!--bandera-->
                                            <input type="hidden" name="vpag_cod" value="<?php echo $resultado[0]['pag_cod']; ?>">

                                            <label class="col-lg-1 control-label">Direccion</label> 
                                            <div class="col-lg-8">
                                                <input disabled type="text" name="vpag_direc" class="form-control" value="<?php echo $resultado[0]['pag_direc']; ?>" required autofocus />
                                            </div>   
                                        </div>
                                        <div class="form-group">
                                            
                                            <label class="col-lg-1 control-label">Nombre</label> 
                                            <div class="col-lg-8">
                                                <input disabled type="text" name="vpag_nombre" class="form-control" value="<?php echo $resultado[0]['pag_nombre']; ?>" required autofocus />
                                            </div>   
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-lg-1 control-label">Modulo</label>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                                                <select name="vmod_cod" class="form-control" required="" readonly onmousedown="return false;"/>
                                                    <?php $consul = consultas::get_datos("select * from v_paginas where pag_cod=".$_GET['vpag_cod']); ?>
                                                    <option value="<?php echo $resultado[0]['mod_cod']; ?>" selected><?php  echo $consul[0]['modulos']; ?>
                                                        
                                                    </option> 
                                                </select>
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


