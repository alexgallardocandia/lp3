<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/img/clientes.png">
        <title>Agregar Clientes</title>
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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-android-person-add"></i>
                                    <h3 class="box-title">Agregar Clientes</h3>
                                    <div class="box-tools">
                                        <a href="clientes_index.php" class="btn btn-primary pull-rigth btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left">    </i>
                                        </a>
                                    </div>
                                </div>
                                <form action="clientes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="vcli_cod" value="0" />
                                        <input type="hidden" name="accion" value="1" /><!--Bandera-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">C.I. N??</label>
                                            <div class="col-lg-4">
                                                <input type="number"  name="vcli_ci" class="form-control" required="" autofocus="" min="1" pattern="^[0-9]+" placeholder="Ingrese el CI del cliente">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_nombre" class="form-control" required="" placeholder="Ingrese el Nombre del cliente"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_apellido" class="form-control" required="" placeholder="Ingrese el apellido del cliente"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Telefono</label>
                                            <div class="col-lg-4">
                                                <input type="text" name="vcli_telefono" class="form-control" required placeholder="Ingrese el telefono del cliente">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Direcci??n</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="vcli_direcc" required placeholder="Ingrese la direcci??n del cliente"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">
                                            <i class="fa fa-remove"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i>Guardar
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
            </div>
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>
