<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/deposito.png">
        <title>Editar Deposito</title>
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
                            <div class="box box-warning"
                            >
                                <div class="box-header"><!--inicio header-->
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Deposito</h3>
                                    <div class="box-tools">
                                        <a href="deposito_index.php" data-title="Volver" class="btn btn-warning pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div><!--fin header-->
                                <form action="deposito_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado=consultas::get_datos("select * from deposito where dep_cod =".$_GET['vdep_cod']);?>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="2"/><!--bandera-->
                                            <input type="hidden" name="vdep_cod" value="<?php echo $resultado[0]['dep_cod']?>"/>


                                            <label class="col-lg-1 control-label">Descripcion</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="vdep_descri" class="form-control" value="<?php echo $resultado[0]['dep_descri']; ?>" required autofocus />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 control-label">Sucursal</label>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                                                <select name="vid_sucursal" class="form-control" required="">
                                                    <optgroup label="Elegido">
                                                        <?php $consul = consultas::get_datos("select * from v_deposito where dep_cod=".$_GET['vdep_cod']); ?>

                                                        <option  selected value="<?php echo $resultado[0]['id_sucursal']; ?>"><?php  echo $consul[0]['suc_descri']; ?>

                                                        </option>

                                                    </optgroup>
                                                    <optgroup label="Actualizar">
                                                        <?php
                                                            $sucu= consultas::get_datos("select * from sucursal");
                                                            foreach ($sucu as $valor){?>
                                                            <option value="<?php echo $valor['id_sucursal']; ?>"><?php echo $valor['id_sucursal']."-".$valor['suc_descri']; ?></option>
                                                        <?php } ?>
                                                    </optgroup>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-warning pull-right">
                                            <i class="ion ion-edit"></i> Modificar
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
