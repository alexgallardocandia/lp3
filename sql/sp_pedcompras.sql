-- Function: sp_pedcompras(integer, integer, character varying, integer, integer, integer)

-- DROP FUNCTION sp_pedcompras(integer, integer, character varying, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_pedcompras(
    ban integer,
    vped_com integer,
    vped_fecha character varying,
    vemp_cod integer,
    vprv_cod integer,
    vid_sucursal integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
begin
	if ban = 1 then --insertar
		INSERT INTO pedido_cabcompra(ped_com, ped_fecha, emp_cod, prv_cod, ped_estado, 
									 id_sucursal)
		VALUES (calcular_ultimo('pedido_cabcompra','ped_com'),current_date, vemp_cod,
		vprv_cod, 'P',vid_sucursal);
		mensaje = 'Se agrego correctamente el pedido de compra*pedcompras_index.php';	
	end if;
	if ban = 2 then 
		update pedido_cabcompra set prv_cod = vprv_cod
		where ped_com = vped_com;
		mensaje = 'Se actualizo correctamente el pedido de compra*pedcompras_index.php';	
	end if;
	if ban = 3 then 
		update pedido_cabcompra set ped_estado ='A'
		where ped_com = vped_com;
		mensaje = 'Se anulo correctamente el pedido de compra*pedcompras_index.php';	
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_pedcompras(integer, integer, character varying, integer, integer, integer)
  OWNER TO postgres;
