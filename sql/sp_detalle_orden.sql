-- Function: sp_detalle_compras(integer, integer, integer, integer, integer, integer)

-- DROP FUNCTION sp_detalle_compras(integer, integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_detalle_orden(
    ban integer,
    vorden_cod integer,
    vdep_cod integer,
    vart_cod integer,
    vorden_cant integer,
    vorden_precio integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
declare tipoi integer;
begin
	if ban = 1 then --insertar 
	select tipo_cod into tipoi from articulo where art_cod = vart_cod; 
	perform * from detalle_orden where orden_cod = vorden_cod and dep_cod = vdep_cod and art_cod = vart_cod;
	if not found then
		INSERT INTO detalle_orden(orden_cod, dep_cod, art_cod, orden_cant, orden_precio, exenta, iva_5, 
		    iva_10)
	    VALUES (vorden_cod, vdep_cod, vart_cod, vorden_cant, vorden_precio, 
	    (case tipoi when 1 then (vorden_cant*vorden_precio) else 0 end),
	    (case tipoi when 2 then (vorden_cant*vorden_precio) else 0 end), 
	    (case tipoi when 3 then (vorden_cant*vorden_precio) else 0 end));
	else
		update detalle_orden set orden_cant = vorden_cant,orden_precio=vorden_precio,
		exenta = (case tipoi when 1 then (vorden_cant*vorden_precio) else 0 end),
		iva_5 = (case tipoi when 2 then (vorden_cant*vorden_precio) else 0 end),
		iva_10 = (case tipoi when 3 then (vorden_cant*vorden_precio) else 0 end)
		where orden_cod = vorden_cod and dep_cod = vdep_cod and art_cod = vart_cod;
	end if;
	    mensaje = 'Se agrego correctamente el articulo a la orden';	
	end if;
	if ban = 2 then --editar
		update detalle_orden set orden_cant = vorden_cant,orden_precio=vorden_precio,
		exenta = (case tipoi when 1 then (vorden_cant*vorden_precio) else 0 end),
		iva_5 = (case tipoi when 2 then (vorden_cant*vorden_precio) else 0 end),
		iva_10 = (case tipoi when 3 then (vorden_cant*vorden_precio) else 0 end)
		where com_cod = vcom_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se actualizo correctamente el articulo a la orden';		
	end if;	
	if ban = 3 then --borrar
		delete from detalle_orden
		where orden_cod = vorden_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se elimino correctamente el articulo a la orden';		
	end if;		
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;	
