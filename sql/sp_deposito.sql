-- FUNCTION: public.sp_deposito(integer, integer, character varying, integer)

-- DROP FUNCTION IF EXISTS public.sp_deposito(integer, integer, character varying, integer);

CREATE OR REPLACE FUNCTION public.sp_deposito(
	ban integer,
	vdep_cod integer,
	vdep_descri character varying,
	vid_sucursal integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
		if ban = 1 then 
INSERT INTO deposito(dep_cod, dep_descri, id_sucursal)
    VALUES (calcular_ultimo('deposito','dep_cod'),trim(upper(vdep_descri)), vid_sucursal);
    mensaje = 'Se guardo correctamente el deposito';
end if ;
if ban = 2 then --modificar
update deposito set dep_descri = vdep_descri, id_sucursal = vid_sucursal
		where dep_cod = vdep_cod;
		mensaje = 'Se actualizo correctamente los datos del deposito';
end if ;
if ban = 3 then --borrar
	perform * from stock where dep_cod = vdep_cod;
	if found then
		mensaje = 'La accion infringe la entidad referencial';
	else
		delete from deposito where dep_cod = vdep_cod;
		mensaje = 'se elimino correctamente el deposito';
	end if;		
end if ;
return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_deposito(integer, integer, character varying, integer)
    OWNER TO postgres;
