-- View: v_orden

-- DROP VIEW v_orden;

CREATE OR REPLACE VIEW v_orden AS 
 SELECT a.orden_cod,
    a.emp_cod,
    (b.emp_nombre::text || ' '::text) || b.emp_apellido::text AS empleado,
    a.prv_cod,
    c.prv_ruc,
    c.prv_razonsocial,
    to_char(a.orden_fecha::timestamp with time zone, 'dd/mm/yyyy'::text) AS orden_fecha,
    a.orden_total,
        CASE a.orden_estado
            WHEN 'P'::text THEN 'PENDIENTE'::text
            WHEN 'C'::text THEN 'CONFIRMADO'::text
            ELSE 'ANULADO'::text
        END AS orden_estado,
    a.id_sucursal,
    d.suc_descri,
    convertir_letra(a.orden_total::numeric) AS totalletra,
    COALESCE(e.ped_com, 0) AS ped_com
   FROM orden_compra a
     JOIN empleado b ON a.emp_cod = b.emp_cod
     JOIN proveedor c ON a.prv_cod = c.prv_cod
     JOIN sucursal d ON a.id_sucursal = d.id_sucursal
     LEFT JOIN ped_orden e ON a.orden_cod = e.ped_com;

ALTER TABLE v_orden
  OWNER TO postgres;
