-- FUNCTION: public.sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer)

-- DROP FUNCTION IF EXISTS public.sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer);

CREATE OR REPLACE FUNCTION public.sp_usuarios(
	ban integer,
	vusu_cod integer,
	vusu_nick character varying,
	vusu_clave character varying,
	vemp_cod integer,
	vgru_cod integer,
	vid_sucursal integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--INSERCION
	if ban = 1 then
		perform * from usuarios where usu_nick = vusu_nick;
		if found then
			mensaje = 'El usuario ya esta creado';
		else
			perform * from empleado where emp_cod = vemp_cod;
			if found then
				mensaje = 'El empleado ya tiene usuario creado';
			else
				insert into usuarios (usu_cod, usu_nick, usu_clave, emp_cod, gru_cod, id_sucursal)
				values ((select coalesce(max(usu_cod),1)+1 from usuarios), vusu_nick, 
						md5(vusu_clave), vemp_cod, vgru_cod, vid_sucursal);
				mensaje = 'Se guardo correctamente un nuevo usuario';
			end if;
		end if;
	end if;
	--MODIFICACION
	if ban = 2 then
		perform * from usuarios where usu_nick = vusu_nick;
		if found then
			mensaje = 'El usuario ya esta creado';
		else
			perform * from empleado where emp_cod = vemp_cod;
			if found then
				mensaje = 'El empleado ya tiene usuario creado';
			else
				update usuarios set usu_nick = vusu_nick, usu_clave = vusu_clave, emp_cod = vemp_cod, gru_cod = vgru_cod, id_sucursal = vid_sucursal
				where usu_cod = vusu_cod;
				mensaje = 'Se actualizo correctamente los datos del usuario';
			end if;
		end if;
	end if;
	--BORRADO
	if ban = 3 then
		perform * from empleado where emp_cod = vemp_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial';
		else
			delete from usuarios
			where usu_cod = vusu_cod;
			mensaje = 'Se borro correctamente';			
		end if;
	end if;
	return mensaje;
	end;
$BODY$;

ALTER FUNCTION public.sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer)
    OWNER TO postgres;
