-- FUNCTION: public.sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION IF EXISTS public.sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.sp_clientes(
	ban integer,
	vcli_cod integer,
	vcli_ci integer,
	vcli_nombre character varying,
	vcli_apellido character varying,
	vcli_telefono character varying,
	vcli_direcc character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
DECLARE mensaje VARCHAR;
BEGIN
	IF	ban = 1 THEN
		INSERT INTO clientes(
		cli_cod, cli_ci, cli_nombre, cli_apellido, cli_telefono, cli_direcc)
		VALUES (calcular_ultimo('clientes','cli_cod'), vcli_ci, vcli_nombre, vcli_apellido
				, vcli_telefono, vcli_direcc);
		mensaje = 'Se guardo correctamente el cliente';
	END IF;
	IF	ban = 2 THEN
		UPDATE clientes
		SET  cli_ci=vcli_ci, cli_nombre=vcli_nombre, cli_apellido=vcli_apellido
		, cli_telefono=vcli_telefono, cli_direcc=vcli_direcc
		WHERE cli_cod = vcli_cod;
		mensaje = 'Se modifico correctamente el cliente';
	END IF;
	IF	ban = 3 THEN
		perform * from pedido_cabventa where cli_cod = vcli_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial';
		else
			DELETE FROM clientes
			WHERE cli_cod = vcli_cod;
			mensaje = 'Se borro correctamente el cliente';
		end if;
		
	END IF;
	return mensaje;
	
END;
$BODY$;

ALTER FUNCTION public.sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying)
    OWNER TO postgres;
