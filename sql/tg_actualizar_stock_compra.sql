-- Trigger: tg_actualizar_stock_compra

-- DROP TRIGGER IF EXISTS tg_actualizar_stock_compra ON public.detalle_compra;

CREATE TRIGGER tg_actualizar_stock_compra
    AFTER INSERT OR DELETE OR UPDATE 
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_compra();