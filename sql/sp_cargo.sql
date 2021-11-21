-- FUNCTION: public.sp_cargo(integer, integer, character varying)

-- DROP FUNCTION IF EXISTS public.sp_cargo(integer, integer, character varying);

CREATE OR REPLACE FUNCTION public.sp_cargo(
	ban integer,
	vcar_cod integer,
	vcar_descri character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--INSERCION
	if ban = 1 then
		insert into cargo (car_cod, car_descri)
		values ((select coalesce(max(car_cod),0)+1 from cargo), upper (trim(vcar_descri)));
		mensaje = 'Se guardo correctamente el cargo*cargo_index.php';
	end if;
	--MODIFICACION
	if ban = 2 then
		update cargo set car_descri = upper (trim(vcar_descri))
		where car_cod = vcar_cod;
		mensaje = 'Se actualizo correctamente el cargo*cargo_index.php';
	end if;
	--BORRADO
	if ban = 3 then
		perform * from empleado where car_cod = vcar_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*cargo_index.php';
		else
			delete from cargo
			where car_cod = vcar_cod;
			mensaje = 'Se borro correctamente el cargo*cargo_index.php';
		end if;
		return mensaje;
	end if;
	if ban = 4 then --insertar en empleados
		insert into cargo(car_cod,car_descri)
		values((select coalesce(max(car_cod),1)+1 from cargo),
		upper(trim(vcar_descri)));
		mensaje = 'Se guardo correctamente el cargo*empleado_add.php';
	end if;
	if ban = 5 then --insertar en usuarios
		insert into cargo(car_cod,car_descri)
		values((select coalesce(max(car_cod),1)+1 from cargo),
		upper(trim(vcar_descri)));
		mensaje = 'Se guardo correctamente el cargo*usuarios_add.php';
	end if;
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_cargo(integer, integer, character varying)
    OWNER TO postgres;
