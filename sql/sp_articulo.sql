-- FUNCTION: public.sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer)

-- DROP FUNCTION IF EXISTS public.sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer);

CREATE OR REPLACE FUNCTION public.sp_articulo(
	ban integer,
	vart_cod integer,
	vart_codbarra character varying,
	vmar_cod integer,
	vart_descri character varying,
	vart_precioc integer,
	vart_preciov integer,
	vtipo_cod integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	if ban = 1 then
		INSERT INTO articulo(art_cod, art_codbarra, mar_cod, 
		art_descri, art_precioc, art_preciov, tipo_cod)
		VALUES (calcular_ultimo('articulo','art_cod'), vart_codbarra, vmar_cod, trim(upper(vart_descri)), 
		vart_precioc, vart_preciov, vtipo_cod);	
		mensaje = 'Se guardo correctamente el articulo';	
	end if;
	if ban = 2 then
		update articulo set art_codbarra = vart_codbarra, mar_cod = vmar_cod, art_descri = vart_descri, art_precioc = vart_precioc, art_preciov = vart_preciov, tipo_cod = vtipo_cod 
		where art_cod = vart_cod;
		mensaje = 'Se actualizo correctamente los datos del articulo';
	end if;
	if ban = 3 then --borrar
		perform * from stock where art_cod = vart_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial';
		else
			delete from articulo where art_cod = vart_cod;
			mensaje = 'se elimino correctamente el articulo';
		end if;
	end if;
	if ban = 4 then --agregar marca
		insert into marca values(calcular_ultimo('marca','mar_cod'),
		trim(upper(vart_descri)));
	mensaje = 'Se guardo correctamente la marca*articulo_add';
	end if;
	if ban = 5 then --tipo impuesto

		

	end if;
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer)
    OWNER TO postgres;
