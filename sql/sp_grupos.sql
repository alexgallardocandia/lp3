-- FUNCTION: public.sp_grupos(integer, integer, character varying)

-- DROP FUNCTION IF EXISTS public.sp_grupos(integer, integer, character varying);

CREATE OR REPLACE FUNCTION public.sp_grupos(
	ban integer,
	vgru_cod integer,
	vgru_nombre character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--INSERCION
	if ban = 1 then
		insert into grupos (gru_cod, gru_nombre)
		values ((select coalesce(max(gru_cod),0)+1 from grupos), upper (trim(vgru_nombre)));
		mensaje = 'Se guardo correctamente el grupo*grupo_index.php';
	end if;
	--MODIFICACION
	if ban = 2 then
		update grupos set gru_nombre = upper (trim(vgru_nombre))
		where gru_cod = vgru_cod;
		mensaje = 'Se actualizo correctamente el grupo*grupo_index.php';
	end if;
	--BORRADO
	if ban = 3 then
		perform * from usuarios where gru_cod = vgru_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*grupo_index.php';
		else
			delete from grupos
			where gru_cod = vgru_cod;
			mensaje = 'Se borro correctamente el grupo*grupo_index.php';
		end if;
	end if;
	if ban = 4 then --insertar
		insert into grupos(gru_cod,gru_nombre)
		values((select coalesce(max(gru_cod),1)+1 from grupos),
		upper(trim(vgru_nombre)));
		mensaje = 'Se guardo correctamente el grupo*usuarios_add.php';
	end if;	
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_grupos(integer, integer, character varying)
    OWNER TO postgres;
