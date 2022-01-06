<?php
require 'clases/conexion.php';
session_start();
if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
$pedidos = consultas::get_datos("select * from v_pedido_caborden where estado = 'PENDIENTE' and id_sucursal =".$_SESSION['id_sucursal']);
//var_dump($pedidos);
?>
<div class="col-lg-4" col-sm-4 col-md-4>
    <select class="form-control select2" name="vorden_cod" id="pedido">
        <?php if (!empty($pedidos)) { ?>
        <option value="">Seleccione un pedido</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['orden_cod']?>"><?php echo "N°:".$pedido['orden_cod']." Fecha:".$pedido['orden_fecha']." Total:".$pedido['orden_total'];?></option>
        <?php }
        }else{ ?>
            <option value="">El Proveedor no posee pedidos</option>
        <?php } ?>
    </select>
</div>
