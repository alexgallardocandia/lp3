-- FUNCTION: public.sp_proveedor(integer, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION IF EXISTS public.sp_proveedor(integer, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.sp_proveedor(
	ban integer,
	vprv_cod integer,
	vprv_ruc character varying,
	vprv_razonsocial character varying,
	vprv_direccion character varying,
	vprv_telefono character varying)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
DECLARE mensaje VARCHAR;
BEGIN
	IF ban = 1 THEN
		INSERT INTO proveedor(prv_cod, prv_ruc, prv_razonsocial, prv_direccion, 
							  prv_telefono)
		VALUES(calcular_ultimo('proveedor','prv_cod'), vprv_ruc,upper(vprv_razonsocial),
			  vprv_direccion, vprv_telefono);
		mensaje = 'Se guardo correctamente el proveedor';
	END IF;
	IF ban = 2 THEN
		UPDATE proveedor
		SET prv_ruc=vprv_ruc, prv_razonsocial=upper(vprv_razonsocial)
		, prv_direccion=vprv_direccion, prv_telefono=vprv_telefono
		WHERE prv_cod=vprv_cod;
		mensaje = 'Se modifico correctamente el proveedor';
	END IF;
	IF ban = 3 THEN
		PERFORM * FROM compras WHERE prv_cod = vprv_cod;
		IF FOUND THEN
			mensaje = 'La accion infringe la entidad referencial';
		ELSE
			DELETE FROM proveedor
			where prv_cod = vprv_cod;
			mensaje = 'Se borro correctamente el proveedor';
		END IF;
	END IF;
	return mensaje;
END;
$BODY$;

ALTER FUNCTION public.sp_proveedor(integer, integer, character varying, character varying, character varying, character varying)
    OWNER TO postgres;
