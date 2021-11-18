<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/índice.png">
        <title>SIGLP3</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
        session_start();/*Reanudar sesion*/
        if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->
        <style type="text/css">
            .small-box{
                background-color: #202020;
                width: 240px;
                height: 120px;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Bienvenido al Sistema Informatico de Gestion LP3
                        <small>Version 1.0</small>
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3 class="hidden-xs hidden-sm">Referenciales</h3>
                                    <span class="info-box-text">Simples, Compuestos</span>    
                                </div>
                                <div class="icon">
                                    <span class="fa fa-list"></span>
                                </div>
                                <a class="small-box-footer" href="#">
                                    Más Info
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3 class="hidden-xs hidden-sm">Ventas</h3>
                                    <span class="info-box-text">Pedido, Venta</span>    
                                </div>
                                <div class="icon">
                                    <i class="ion ion-card"></i>
                                </div>
                                <a class="small-box-footer" href="#">
                                    Más Info
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3 class="hidden-xs hidden-sm">Compras</h3>
                                    <span class="info-box-text">Pedido, Compra</span>    
                                </div>
                                <div class="icon">
                                    <span class="fa fa-cart-plus"></span>
                                </div>
                                <a class="small-box-footer" href="#">
                                    Más Info
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3 class="hidden-xs hidden-sm">Informes</h3>
                                    <span class="info-box-text">Filtro, Imprimir</span>    
                                </div>
                                <div class="icon">
                                    <span class="fa fa-clipboard"></span>
                                </div>
                                <a class="small-box-footer" href="#">
                                    Más Info
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>     
            </div>
          <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
        </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


