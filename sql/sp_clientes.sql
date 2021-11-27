-- Function: sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION sp_clientes(
    ban integer,
    vcli_cod integer,
    vcli_ci integer,
    vcli_nombre character varying,
    vcli_apellido character varying,
    vcli_telefono character varying,
    vcli_direcc character varying)
  RETURNS character varying AS
$BODY$
DECLARE mensaje VARCHAR;
BEGIN
	IF	ban = 1 THEN
		perform * from clientes where cli_ci=vcli_ci;
		if found then
			mensaje = 'El ci ya esta registrado*clientes_index.php';
		else
			INSERT INTO clientes(
			cli_cod, cli_ci, cli_nombre, cli_apellido, cli_telefono, cli_direcc)
			VALUES (calcular_ultimo('clientes','cli_cod'), vcli_ci, vcli_nombre, vcli_apellido
					, vcli_telefono, vcli_direcc);
			mensaje = 'Se guardo correctamente el cliente*clientes_index.php';
		end if;		
	END IF;
	IF	ban = 2 THEN
		UPDATE clientes
		SET  cli_ci=vcli_ci, cli_nombre=vcli_nombre, cli_apellido=vcli_apellido
		, cli_telefono=vcli_telefono, cli_direcc=vcli_direcc
		WHERE cli_cod = vcli_cod;
		mensaje = 'Se modifico correctamente el cliente*clientes_index.php';
	END IF;
	IF	ban = 3 THEN
		perform * from pedido_cabventa where cli_cod = vcli_cod;
		if found then
			mensaje = 'La accion infringe la entidad referencial*clientes_index.php';
		else
			perform * from ventas where cli_cod = vcli_cod;
			if found then
				mensaje = 'La accion infringe la entidad referencial*clientes_index.php';
			else
				DELETE FROM clientes
				WHERE cli_cod = vcli_cod;
				mensaje = 'Se borro correctamente el cliente*clientes_index.php';
			end if;
		end if;
		
	END IF;
	IF	ban = 4 THEN
		perform * from clientes where cli_ci=vcli_ci;
		if found then
			mensaje = 'El ci ya esta registrado*pedventas_add.php';
		else
			INSERT INTO clientes(
			cli_cod, cli_ci, cli_nombre, cli_apellido, cli_telefono, cli_direcc)
			VALUES (calcular_ultimo('clientes','cli_cod'), vcli_ci, vcli_nombre, vcli_apellido
					, vcli_telefono, vcli_direcc);
			mensaje = 'Se guardo correctamente el cliente*pedventas_add.php';
		end if;
	END IF;
	IF	ban = 5 THEN
		perform * from clientes where cli_ci=vcli_ci;
		if found then
			mensaje = 'El ci ya esta registrado*ventas_add.php';
		else
			INSERT INTO clientes(
			cli_cod, cli_ci, cli_nombre, cli_apellido, cli_telefono, cli_direcc)
			VALUES (calcular_ultimo('clientes','cli_cod'), vcli_ci, vcli_nombre, vcli_apellido
					, vcli_telefono, vcli_direcc);
			mensaje = 'Se guardo correctamente el cliente*ventas_add.php';
		end if;
	END IF;
	return mensaje;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying)
  OWNER TO postgres;
