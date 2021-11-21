<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/clave.png">
        <title>CAMBIAR CLAVE</title>
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
                                    <i class="fa fa-expeditedssl" aria-hidden="true"></i>

                                    <h3 class="box-title">Cambiar Clave</h3>

                                </div><!--fin header-->
                                <form action="cambiar_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                    	 <div class="form-group">
                                            <label class="col-lg-3 control-label">Usuario</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="vusu_nick" value="<?php echo $_SESSION['usu_nick'] ?>" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="1"/><!--bandera-->
                                            <label class="col-lg-3 control-label">Clave Actual</label>
                                            <div class="col-lg-8">
                                                <input type="password" name="vclave_actual" class="form-control" required autofocus />
                                            </div>
                                        </div>
                                        <?php
                                          $con = "select usu_clave from v_usuarios where usu_nick='".$_SESSION['usu_nick']."'";
                                          $clave = consultas::get_datos($con);
                                          if ($clave[0]['usu_clave']== $_REQUEST['vclave_actual']) {?>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Clave Nueva</label>
                                                <div class="col-lg-8">
                                                    <input type="password" name="vclave_nueva" class="form-control" required autofocus />
                                                </div>
                                            </div>
                                        <?php }else{?>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Clave Nueva</label>
                                                <div class="col-lg-8">
                                                    <input type="password" name="vclave_nueva" class="form-control" required autofocus disabled />
                                                </div>
                                            </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Repita Clave Nueva</label>
                                            <div class="col-lg-8">
                                                <input type="password" name="vclave_nuevar" class="form-control" required autofocus />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Actualizar
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
