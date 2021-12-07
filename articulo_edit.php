<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/articulo.png">
        <title>Editar Articulo</title>
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
                                    <h3 class="box-title">Editar Articulo</h3>
                                    <div class="box-tools">
                                        <a href="articulo_index.php" class="btn btn-warning pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div><!--fin header-->
                                <form action="articulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado=consultas::get_datos("select * from v_articulo where art_cod =".$_GET['vart_cod'])?>
                                        <div class="form-group">
                                             <label class="control-label col-sm-2">Cod. Barra:</label>
                                            <div class="col-lg-6">
                                            <input type="hidden" name="accion" value="2"/><!--bandera-->
                                            <input type="hidden" name="vart_cod" value="<?php echo $resultado[0]['art_cod']?>"/>
                                            <input type="text"  name="vart_codbarra" class="form-control" value="<?php echo $resultado[0]['art_codbarra'];?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Marca:</label>
                                            <div class="col-lg-6">
                                                <select name="vmar_cod" class="form-control" required="">
                                                    <optgroup label="Elegido">
                                                        <?php $consul = consultas::get_datos("select * from v_articulo where art_cod=".$_GET['vart_cod']); ?>
                                                        <option value="<?php echo $resultado[0]['mar_cod']; ?>" selected><?php  echo $consul[0]['mar_descri']; ?>

                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Actualizar">
                                                        <?php
                                                        $modu= consultas::get_datos("select * from marca");
                                                        foreach ($modu as $valor){?>
                                                        <option value="<?php echo $valor['mar_cod']; ?>"><?php echo $valor['mar_cod']."-".$valor['mar_descri']; ?></option>
                                                        <?php } ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Descripción:</label>
                                            <div class="col-lg-6">
                                            <input type="text" name="vart_descri" class="form-control" value="<?php echo $resultado[0]['art_descri'];?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">P. Compra:</label>
                                            <div class="col-lg-6">
                                            <input type="number" min="1" pattern="^[0-9]+" name="vart_precioc" class="form-control" value="<?php echo $resultado[0]['art_precioc'];?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">P. Venta:</label>
                                            <div class="col-lg-6">
                                            <input type="number" min="1" pattern="^[0-9]+" name="vart_preciov" class="form-control" value="<?php echo $resultado[0]['art_preciov'];?>" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Tipo Impuesto:</label>
                                            <div class="col-lg-6">
                                                <select name="vtipo_cod" class="form-control" required="">
                                                    <optgroup label="Elegido">
                                                        <?php $consul = consultas::get_datos("select * from v_articulo where art_cod=".$_GET['vart_cod']); ?>
                                                        <option value="<?php echo $resultado[0]['tipo_cod']; ?>" selected><?php  echo $consul[0]['tipo_descri']; ?>

                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Actualizar">
                                                        <?php
                                                        $modu= consultas::get_datos("select * from tipo_impuesto");
                                                        foreach ($modu as $valor){?>
                                                        <option value="<?php echo $valor['tipo_cod']; ?>"><?php echo $valor['tipo_cod']."-".$valor['tipo_descri']; ?></option>
                                                        <?php } ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-warning pull-right">
                                            <i class="fa fa-edit"></i>Modificar
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
