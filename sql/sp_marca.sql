-- FUNCTION: public.sp_marca(integer, integer, character varying)

-- DROP FUNCTION IF EXISTS public.sp_marca(integer, integer, character varying);

CREATE OR REPLACE FUNCTION public.sp_marca(
	ban integer,
	vmar_cod integer,
	vmar_descri character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--sentencias sql
	if ban = 1 then --insertar
		insert into marca(mar_cod,mar_descri)
		values((select coalesce(max(mar_cod),1)+1 from marca),
		upper(trim(vmar_descri)));
		mensaje = 'Se guardo correctamente la marca*marca_index.php';
	end if;
	if ban = 2 then
		update marca set mar_descri = upper(trim(vmar_descri))
		where mar_cod = vmar_cod;
		mensaje = 'Se actualizo correctamente la marca*marca_index.php';
	end if;
	if ban = 3 then
		perform * from articulo where mar_cod = vmar_cod;
		if found then
			 mensaje = 'La accion infringe la entidad referencial*marca_index.php	';
		else
			delete from marca
			where mar_cod = vmar_cod;
			mensaje = 'Se elimino correctamente la marca*marca_index.php';
		end if;
		
	end if;	
	if ban = 4 then --insertar
		insert into marca(mar_cod,mar_descri)
		values((select coalesce(max(mar_cod),1)+1 from marca),
		upper(trim(vmar_descri)));
		mensaje = 'Se guardo correctamente la marca*articulo_add.php';
	end if;	
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_marca(integer, integer, character varying)
    OWNER TO postgres;
