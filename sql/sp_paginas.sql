-- FUNCTION: public.sp_paginas(integer, integer, character varying, character varying, integer)

-- DROP FUNCTION IF EXISTS public.sp_paginas(integer, integer, character varying, character varying, integer);

CREATE OR REPLACE FUNCTION public.sp_paginas(
	ban integer,
	vpag_cod integer,
	vpag_direc character varying,
	vpag_nombre character varying,
	vmod_cod integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
begin
	--INSERCION
	if ban = 1 then
		insert into paginas (pag_cod, pag_direc, pag_nombre, mod_cod)
		values ((select coalesce(max(pag_cod),1)+1 from paginas),  vpag_direc,trim(upper( vpag_nombre)), vmod_cod);
		mensaje = 'Se guardo correctamente una nueva pagina*paginas_index.php';
	end if;
	--MODIFICACION
	if ban = 2 then
		update paginas set pag_direc = vpag_direc, pag_nombre = vpag_nombre, mod_cod = vmod_cod
		where pag_cod = vpag_cod;
		mensaje = 'Se actualizo correctamente los datos de la pagina*paginas_index.php';
	end if;
	--BORRADO
	if ban = 3 then
		perform * from modulos where mod_cod = vmod_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*paginas_index.php';
		else
			delete from paginas
			where pag_cod = vpag_cod;
			mensaje = 'Se borro correctamente*paginas_index.php';
		end if;
	end if;
	if ban = 4 then --agregar marca
		insert into modulos values(calcular_ultimo('modulos','mod_cod'),
		trim(upper(vmod_nombre)));
	mensaje = 'Se guardo correctamente el modulo*paginas_add.php';
	end if;
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_paginas(integer, integer, character varying, character varying, integer)
    OWNER TO postgres;
