-- FUNCTION: public.sp_empleado(integer, integer, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION IF EXISTS public.sp_empleado(integer, integer, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.sp_empleado(
	ban integer,
	vemp_cod integer,
	vcar_cod integer,
	vemp_nombre character varying,
	vemp_apellido character varying,
	vemp_direcc character varying,
	vemp_tel character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
 declare mensaje varchar;
 begin
 if ban = 1 then
		INSERT INTO empleado(emp_cod, car_cod, emp_nombre, emp_apellido, emp_direcc, emp_tel)
    VALUES ((select coalesce(max(emp_cod),1)+1 from empleado),vcar_cod,trim(upper(vemp_nombre)),trim(upper(vemp_apellido)),trim(upper(vemp_direcc)),vemp_tel);
		mensaje = 'Se guardo correctamente el empleado*empleado_index.php';	
	end if;
		if ban = 2 then
		update empleado set car_cod = vcar_cod, emp_nombre = vemp_nombre, emp_apellido = vemp_apellido, emp_direcc = vemp_direcc, emp_tel = vemp_tel 
		where emp_cod = vemp_cod;
		mensaje = 'Se actualizo correctamente los datos del empleado';
	end if;
	if ban = 3 then --borrar
		perform * from compras where emp_cod = vemp_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial';
		else
			perform * from usuarios where emp_cod=vemp_cod;
			if found then
				mensaje = 'La accion infringe la entidad referencial';
			else
				delete from empleado where emp_cod = vemp_cod;
				mensaje = 'se elimino correctamente el empleado';
			end if;
		end if;
		return mensaje;
	end if; 
		
	if ban = 4 then --agregar marca
		insert into cargo values(calcular_ultimo('cargo','car_cod'),
		trim(upper(vemp_nombre)));
	mensaje = 'Se guardo correctamente la marca*empleado_add.php';
	end if;
	return mensaje;
 end;
 
$BODY$;

ALTER FUNCTION public.sp_empleado(integer, integer, integer, character varying, character varying, character varying, character varying)
    OWNER TO postgres;
