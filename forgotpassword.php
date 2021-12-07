<?php
session_start();
if ($_SESSION) {
	session_destroy();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>SIGLP3</title>
		<link rel="icon" type="favicon" href="img/índice.png"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <?php

    require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

		<style>
    @media (min-width: 768px){
        .sidebar-mini.sidebar-collapse .main-header .logo>.logo-mini {
            display: block;
            margin-left: -15px;
            margin-right: -15px;
            font-size: 14px;
        }
    }

    .skin-yellow .main-header .logo {
        /*background-color: #FFCF6E;*/
        /*background-color: #7F7BFF;*/
        background-color: #9390FF;
        color: #fff;
        /*color:#425d69;*/
        border-bottom: 0 solid transparent;
    }
    .skin-yellow .main-header .logo:hover {
        /*background-color: #FFBB30;*/
        background-color: #7B76FF;
        color: #fff;
        /*color:#425d69;*/
        border-bottom: 0 solid transparent;
    }
    .skin-yellow .main-header .navbar .sidebar-toggle {
        color:#fff;
        /*color:#425d69;*/

    }

    .skin-yellow .main-header .navbar .sidebar-toggle:hover {
        /*background-color: #e08e0b;*/
        background-color: #7B76FF;
        /*color:#425d69;*/
        color:#fff;

    }
    .skin-yellow .main-header .navbar {
        /*background-color: #f39c12;*/
        /*background-color: #FFCF6E;*/
        background-color: #AEABFF;
    }

    .skin-yellow .main-header .navbar .nav>li>a {
        color: #fff;
        /*color: #425d69;*/
    }
    /*    .skin-yellow .main-header li.user-header {
            background-color: #f39c12;
            background-color: darkgray;
            background: #1e282c;

        }*/

    .skin-blue .main-header li.user-header {
        /*background-color: #3c8dbc;*/
        background-color: lightgray;
    }

    .navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
        z-index: 5;
        /*color: #fff;*/
        color: #1e282c;
        /*color: rgba(255,255,255,0.8);*/
        font-size: 17px;
        margin-top: 10px;
    }

    .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
        /*background-color: #1e282c;*/
        background-color: darkgray;
        padding: 10px;
    }

    .skin-yellow .sidebar-menu>li:hover>a, .skin-yellow .sidebar-menu>li.active>a {
        color: #fff;
        background: #1e282c;
        border-left-color: #AEABFF;
    }

    .alert-info {
        color: #31708f !important;
        background-color: #d9edf7 !important;
        border-color: #bce8f1 !important;
    }
    .alert-warning {
        color: #8a6d3b !important;
        background-color: #fcf8e3 !important;
        border-color: #faebcc !important;
    }
    .alert-danger {
        color: #a94442 !important;
        background-color: #f2dede !important;
        border-color: #ebccd1 !important;
    }
    .alert-success {
        color: #3c763d !important;
        background-color: #dff0d8 !important;
        border-color: #d6e9c6 !important;
    }
</style>

<style>
    .login-box{
        width: 360px;
        margin: 5% auto;

    }
    .login-page, .register-page {
        background: #d2d6de;
        /*background: #F6F4E6;*/
    }
    /*.btn-primary {
        color: #fff;
        background-color: #425d69;
        border-color: #425d69;
    }
    .btn-primary:hover,.btn-primary:active,.btn-primary:focus {
        background-color: #587E8E;
        border-color: #587E8E;
    }*/
</style>

<style>
    @media only screen and (max-width: 800px) {

        /* Force table to not be like tables anymore */
        #no-more-tables table,
        #no-more-tables thead,
        #no-more-tables tbody,
        #no-more-tables th,
        #no-more-tables td,
        #no-more-tables tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        #no-more-tables tr { border: 1px solid #ccc; }

        #no-more-tables td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            white-space: normal;
            text-align:left;
        }

        #no-more-tables td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align:left;
            font-weight: bold;
        }

        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
    }
</style>

<style>
    #IrArriba {
        position: fixed;
        bottom: 30px;
        right: 50%;
        background-color: transparent;
        opacity: 0.7;
    }
    #IrArriba a {
        text-decoration: none;
        color: #fff;
        text-shadow:none !important;
    }
    #IrArriba span {
        width: 66px;
        height: 66px;
        display: block;
        background: url(/sigest/img/subir.png) no-repeat center center;
        cursor:pointer;
    }
</style>

<style>
    /***
Bootstrap Line Tabs by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

    /* Tabs panel */
    .tabbable-panel {
        border:1px solid #eee;
        padding: 10px;
    }

    /* Default mode */
    .tabbable-line > .nav-tabs {
        border: none;
        margin: 0px;
    }
    .tabbable-line > .nav-tabs > li {
        margin-right: 2px;
    }
    .tabbable-line > .nav-tabs > li > a {
        border: 0;
        margin-right: 0;
        color: #737373;
    }
    .tabbable-line > .nav-tabs > li > a > i {
        color: #a6a6a6;
    }
    .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
        border-bottom: 4px solid #fbcdcf;
    }
    .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
        border: 0;
        background: none !important;
        color: #333333;
    }
    .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
        color: #a6a6a6;
    }
    .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
        margin-top: 0px;
    }
    .tabbable-line > .nav-tabs > li.active {
        border-bottom: 4px solid #f3565d;
        position: relative;
    }
    .tabbable-line > .nav-tabs > li.active > a {
        border: 0;
        color: #333333;
    }
    .tabbable-line > .nav-tabs > li.active > a > i {
        color: #404040;
    }
    .tabbable-line > .tab-content {
        margin-top: -3px;
        background-color: #fff;
        border: 0;
        border-top: 1px solid #eee;
        padding: 15px 0;
    }
    .portlet .tabbable-line > .tab-content {
        padding-bottom: 0;
    }

    /* Below tabs mode */

    .tabbable-line.tabs-below > .nav-tabs > li {
        border-top: 4px solid transparent;
    }
    .tabbable-line.tabs-below > .nav-tabs > li > a {
        margin-top: 0;
    }
    .tabbable-line.tabs-below > .nav-tabs > li:hover {
        border-bottom: 0;
        border-top: 4px solid #fbcdcf;
    }
    .tabbable-line.tabs-below > .nav-tabs > li.active {
        margin-bottom: -2px;
        border-bottom: 0;
        border-top: 4px solid #f3565d;
    }
    .tabbable-line.tabs-below > .tab-content {
        margin-top: -10px;
        border-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
</style>
<style type="text/css">
    .center_loader { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); transform: -webkit-translate(-50%, -50%); transform: -moz-translate(-50%, -50%); transform: -ms-translate(-50%, -50%); color:darkred; }
</style>
<style>
.loader {
  border: 0px solid #ccc;
  padding: 20px;
}
.loader_ajax_small {
  border: 4px solid #f3f3f3 !important;
  border-radius: 50%;
  border-top: 2px solid #2D2D2D !important;
  width: 29px;
  height: 29px;
  margin: 0 auto;
  -webkit-animation: spin_loader_ajax_small 2s linear infinite;
  animation: spin_loader_ajax_small 2s linear infinite;
}

@-webkit-keyframes spin_loader_ajax_small {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin_loader_ajax_small {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
 <style>
            body, html {
               background: url(img/constructor.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
           		display: flex;
   				align-items: center;
				width: 100vw;
				height: 100vh;
				margin:0 auto;

            }
</style>
<!--ARCHIVOS CSS-->
		<style type="text/css">
			.login-box-body{
				background-color: #ffffff;
				padding: 6%;
				margin-top: 7%;
				height: 192px;
				font-size: 13px !important;
			}
			.login-logo{

				height: 95px;
				text-align: center;

			}
			.login-logo span img{
				margin-top: 2px;
				padding: 4px;

			}
			.form-control{
				border-radius: 0px;
				font-size: 10pt;
			}
			/*
			body{
				display: flex;
   				align-items: center;
				width: 100vw;
				height: 100vh;
				margin:0 auto;

				padding-top: 40px;
				padding-bottom: 40px;
				background-image:linear-gradient(#020052, #0241a9,#009bff);
				  background-attachment: fixed;
			}
			.login{
				max-width: 330px;
				padding: 15px;
				margin: 0 auto;
			}
			#sha{
				max-width: 340px;
				-webkit-box-shadow:0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				-moz-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				border-radius: 6%;
			}
			#avatar{
				width: 96px;
				height: 96px;
				margin: 0px auto 10px;
				display: block;
				border-radius: 50%;
			}*/
		</style>
	</head>
	<body>
		<div class="container">
 			<div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <a href="index.php" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i>Volver</a>
                        </div>
                    </div>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

		<!--<div class="container well" id="sha" >

			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<img src="img/avatar.png" class="img-responsive" id="avatar"/>
				</div>
			</div>

			<form class="login" action="acceso.php" method="post">
				<div class="form-group input-group">
					<input type="text" class="form-control" name="usuario" required="" autofocus="" placeholder="Ingrese su usuario"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				</div>
				<div class="form-group input-group">
					<input type="password" class="form-control" name="clave" required="" autofocus="" placeholder="Ingrese su clave"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>
				<div class="checkbox">
					<label class="checkbox">
						<input type="checkbox" value="1" name="recuerdame"/>No cerrar sesion
					</label>
					<p class="help-block"><a href="#">No puede acceder a su cuenta?</a></p>
				</div>-->


			<!--</form>
		</div>-->
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#error").delay(4000).slideUp(200, function(){
                $(this).alert('close');
            });
        </script>

		<script src="js/jquery-1.12.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
