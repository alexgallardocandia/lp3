<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/tipo.png">
        <title>Agregar Impuesto</title>
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
                            <div class="box box-primary"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Impuesto</h3>
                                    <div class="box-tools">
                                        <a href="tipo_index.php" data-title="Volver" rel="tooltip" data-placement="top" class="btn btn-primary pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div><!--fin header-->
                                <form action="tipo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="1"/><!--bandera-->
                                            <input type="hidden" name="vtipo_cod" value="0">
                                            <label class="col-lg-1 control-label">Descripci??n</label> 
                                            <div class="col-lg-8">
                                                <input type="text" name="vtipo_descri" class="form-control" required autofocus />
                                            </div>   
                                        </div>      
                                        <div class="form-group">
                                            <label class="control-label col-lg-1">Porcentaje</label>
                                            <div class="col-lg-8">
                                                <input type="number" name="vtipo_porcen" class="form-control" required >    
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="fa fa-floppy-o btn btn-primary pull-right"> Registrar</button>
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


