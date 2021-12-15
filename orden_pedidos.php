<?php
require 'clases/conexion.php';
session_start();
if (!isset($_SESSION['usu_nick'])) {
            header('location: index.php');
        };
$pedidos = consultas::get_datos("select * from v_pedido_cabcompra where estado = 'PENDIENTE' and id_sucursal =".$_SESSION['id_sucursal']);
//var_dump($pedidos);
?>
<div class="col-lg-4" col-sm-4 col-md-4>
    <select class="form-control select2" id="pedido" name="vped_com">
        <?php if (!empty($pedidos)) { ?>
        <option value="">Seleccione un pedido</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['ped_com']?>"><?php echo "N°:".$pedido['ped_com']." Fecha:".$pedido['com_fecha']." Total:".$pedido['ped_total']." Sucursal:".$pedido['suc_descri'];?></option>
        <?php }
        }else{ ?>
            <option value="">No posee pedidos Pendientes</option>
        <?php } ?>
    </select>
</div>
