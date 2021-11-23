-- Trigger: tg_insertar_stock

-- DROP TRIGGER IF EXISTS tg_insertar_stock ON public.detalle_compra;

CREATE TRIGGER tg_insertar_stock
    BEFORE INSERT
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();