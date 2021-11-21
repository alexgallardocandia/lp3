-- FUNCTION: public.sp_tipo(integer, integer, character varying, integer)

-- DROP FUNCTION IF EXISTS public.sp_tipo(integer, integer, character varying, integer);

CREATE OR REPLACE FUNCTION public.sp_tipo(
	ban integer,
	vtipo_cod integer,
	vtipo_descri character varying,
	vtipo_porcen integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--INSERCION
	if ban = 1 then
		insert into tipo_impuesto (tipo_cod, tipo_descri,tipo_porcen)
		values ((select coalesce(max(tipo_cod),0)+1 from tipo_impuesto), trim(upper(vtipo_descri)),vtipo_porcen);
		mensaje = 'Se guardo correctamente el tipo de impuesto*tipo_index.php';
	end if;
	--MODIFICACION
	if ban = 2 then
		update tipo_impuesto set tipo_descri = upper (trim(vtipo_descri)),tipo_porcen = vtipo_porcen
		where tipo_cod = vtipo_cod;
		mensaje = 'Se actualizo correctamente el tipo de impuesto*tipo_index.php';
	end if;
	--BORRADO
	if ban = 3 then
		perform * from articulo where tipo_cod = vtipo_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*tipo_index.php';
		else
			delete from tipo_impuesto
			where tipo_cod = vtipo_cod;
			mensaje = 'Se borro correctamente el tipo de impuesto*tipo_index.php';
		end if;
	end if;
		--AGG EN ART
	if ban =4 then
		insert into tipo_impuesto (tipo_cod, tipo_descri,tipo_porcen)
		values ((select coalesce(max(tipo_cod),0)+1 from tipo_impuesto), trim(upper(vtipo_descri)),vtipo_porcen);
		mensaje = 'Se guardo correctamente el tipo de impuesto*articulo_add.php';
	end if;

	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_tipo(integer, integer, character varying, integer)
    OWNER TO postgres;
