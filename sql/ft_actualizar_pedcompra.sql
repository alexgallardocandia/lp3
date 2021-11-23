CREATE OR REPLACE FUNCTION public.ft_actualizar_pedcompra()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
declare det record;
declare tipoi integer;
begin
	if TG_OP = 'INSERT' then
		update pedido_cabcompra set estado = 'C'
		where ped_com = new.ped_com;

		for det in select * from detalle_pedcompra 
		where ped_com = new.ped_com loop
		--obtener codigo de impuesto del articulo
		select tipo_cod into tipoi from articulo where art_cod = det.art_cod;
		
			INSERT INTO detalle_compra(com_cod, dep_cod, art_cod, com_cant, com_precio, exenta, iva_5, 
		    iva_10)
		VALUES (new.com_cod, det.dep_cod, det.art_cod, det.com_cant, det.com_precio, 
		(case tipoi when 1 then (det.com_cant*det.com_precio) else 0 end),
		(case tipoi when 2 then (det.com_cant*det.com_precio) else 0 end), 
		(case tipoi when 3 then (det.com_cant*det.com_precio) else 0 end));
		end loop;
		return new;
	end if;
end;
$BODY$;

ALTER FUNCTION public.ft_actualizar_pedcompra()
    OWNER TO postgres;
