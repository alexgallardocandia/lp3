-- FUNCTION: public.sp_modulos(integer, integer, character varying)

-- DROP FUNCTION IF EXISTS public.sp_modulos(integer, integer, character varying);

CREATE OR REPLACE FUNCTION public.sp_modulos(
	ban integer,
	vmod_cod integer,
	vmod_nombre character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--sentencias sql
	if ban = 1 then --insertar
		insert into modulos(mod_cod,mod_nombre)
		values((select coalesce(max(mod_cod),1)+1 from modulos),
		upper(trim(vmod_nombre)));
		mensaje = 'Se guardo correctamente los modulos*modulo_index.php';
	end if;
	if ban = 2 then
		update modulos set mod_nombre = upper(trim(vmod_nombre))
		where mod_cod = vmod_cod;
		mensaje = 'Se actualizo correctamente los modulos*modulo_index.php';
	end if;
	if ban = 3 then
		perform * from paginas where mod_cod = vmod_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*modulo_index.php';
		else
			delete from modulos
			where mod_cod = vmod_cod;
			mensaje = 'Se elimino correctamente los modulos*modulo_index.php';
		end if;
		
	end if;	
	if ban = 4 then --insertar
		insert into modulos(mod_cod,mod_nombre)
		values((select coalesce(max(mod_cod),1)+1 from modulos),
		upper(trim(vmod_nombre)));
		mensaje = 'Se guardo correctamente los modulos*paginas_add.php';
	end if;	
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_modulos(integer, integer, character varying)
    OWNER TO postgres;
