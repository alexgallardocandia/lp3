CREATE OR REPLACE FUNCTION sp_orden(
    ban integer,
    vorden_cod integer,
    vemp_cod integer,
    vprv_cod integer,
    vorden_fecha character varying,
    vid_sucursal integer,
    vped_com integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
declare ultven integer;
begin
	if ban = 1 then --insertar
		INSERT INTO orden_compra(
			    orden_cod, prv_cod, emp_cod, id_sucursal, orden_fecha, orden_total, 
			    orden_estado)
		    VALUES (calcular_ultimo('orden_compra','orden_cod'), vprv_cod, vemp_cod, vid_sucursal,TO_DATE(vorden_fecha, 'YYYY/MM/DD'),
		      0, 'P') returning orden_cod into ultven ;	
		     if vped_com > 0 then
			insert into ped_orden(ped_com,orden_cod,obs_pedido)
			values(vped_com,ultven,'CONFIRMADO EN FECHA '||now());
		     end if;
		     mensaje = 'Se guardo correctamente la orden*orden_det.php?vorden_cod='||ultven;
	end if;
	if ban = 2 then --confirmar
		update orden_compra set orden_estado = 'C'
		where orden_cod = vorden_cod;
		mensaje = 'Se confirmo correctamente la orden*orden_index.php';
	end if;
	if ban = 3 then --anular
		update orden_compra set orden_estado = 'A'
		where orden_cod = vorden_cod;
		mensaje = 'Se anulo correctamente la orden*orden_index.php';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
