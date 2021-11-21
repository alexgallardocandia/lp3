-- FUNCTION: public.sp_sucursal(integer, integer, character varying)

-- DROP FUNCTION IF EXISTS public.sp_sucursal(integer, integer, character varying);

CREATE OR REPLACE FUNCTION public.sp_sucursal(
	ban integer,
	vid_sucursal integer,
	vsuc_descri character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
declare consulta varchar;
begin
	--sentencias sql
	if ban = 1 then --insertar
		insert into sucursal(id_sucursal,suc_descri)
		values((select coalesce(max(id_sucursal),1)+1 from sucursal),
		upper(trim(vsuc_descri)));
		mensaje = 'Se guardo correctamente la sucursal*sucursal_index.php';
	end if;
	if ban = 2 then
		update sucursal set suc_descri = upper(trim(vsuc_descri))
		where id_sucursal = vid_sucursal;
		mensaje = 'Se actualizo correctamente la sucursal*sucursal_index.php';
	end if;
	if ban = 3 then
		perform * from usuarios where id_sucursal=vid_sucursal;
		
		if found then
			mensaje = 'La accion infringe la entidad referencial*sucursal_index.php';
		else
			delete from sucursal
			where id_sucursal = vid_sucursal;
			mensaje = 'Se elimino correctamente la sucursal*sucursal_index.php';
		end if;
			
	end if;	
	if ban = 4 then --insertar
		insert into sucursal(id_sucursal,suc_descri)
		values((select coalesce(max(id_sucursal),1)+1 from sucursal),
		upper(trim(vsuc_descri)));
		mensaje = 'Se guardo correctamente la sucursal*deposito_add.php';
	end if;	
	if ban = 5 then --insertar
		insert into sucursal(id_sucursal,suc_descri)
		values((select coalesce(max(id_sucursal),1)+1 from sucursal),
		upper(trim(vsuc_descri)));
		mensaje = 'Se guardo correctamente la sucursal*usuarios_add.php';
	end if;	
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_sucursal(integer, integer, character varying)
    OWNER TO postgres;
