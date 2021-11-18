<?php
include_once './tcpdf/tcpdf.php';
include_once 'clases/conexion.php';
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0,0, 'Pag. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 
                false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alexander Gallardo');
$pdf->SetTitle('REPORTE DE ARTICULO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------

// TIPO DE LETRA
$pdf->SetFont('times', 'B, U', 16);

// AGREGAR PAGINA
$pdf->AddPage('L','Letter');
$pdf->Cell(0,0,"REPORTE DE ARTICULO",0,1,'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0 ,0, 0);
        $pdf->SetDrawColor(234, 234, 234);
        $pdf->SetLineWidth(0.0);

        
        $pdf->SetFont('', 'B',12);
        // Header        
        $pdf->SetFillColor(0, 139, 200);
        $pdf->SetLineWidth(0.0);
        $pdf->SetTextColor( 255, 255, 255 );
        $pdf->Cell(20,5,'CODIGO', 1, 0, 'C', 1);
        $pdf->Cell(40,5,'C. BARRA', 1, 0, 'C', 1);
        $pdf->Cell(50,5,'DESCRIPCION', 1, 0, 'C',1);
        $pdf->Cell(40,5,'MARCA', 1, 0, 'C', 1);
        $pdf->Cell(40,5,'PRECIO COMPRA', 1, 0, 'C', 1);
        $pdf->Cell(40,5,'PRECIO VENTA', 1, 0, 'C', 1);
        $pdf->Cell(40,5,'IMPUESTO', 1, 0, 'C', 1);
        
        $pdf->Ln();
        $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        //CONSULTAS DE LOS REGISTROS
        if (!empty(isset($_REQUEST['vdesde'])) && !empty(isset($_REQUEST['vhasta']))) {
            if ($_REQUEST['opcion'] == 1) { //por codigo
                $articulos = consultas::get_datos("select * from v_articulo where art_cod between ".$_REQUEST['vdesde']." and ".$_REQUEST['vhasta']);
            }else{//por descripcion
                $articulos = consultas::get_datos("select * from v_articulo where art_descri between '".$_REQUEST['vdesde']."' and '".$_REQUEST['vhasta']."'");
            }
        }else{
            $articulos = consultas::get_datos("select * from v_articulo order by art_cod");
        }
        if (!empty($articulos)) {
            foreach ($articulos as $a) {
            $pdf->Cell(20,5,$a['art_cod'], 1, 0, 'C', 1);
            $pdf->Cell(40,5,$a['art_codbarra'], 1, 0, 'C', 1);
            $pdf->Cell(50,5,$a['art_descri'], 1, 0, 'L', 1);
            $pdf->Cell(40,5,$a['mar_cod']."-".$a['mar_descri'], 1, 0, 'L', 1);
            $pdf->Cell(40,5,$a['art_precioc'], 1, 0, 'C', 1);
            $pdf->Cell(40,5,$a['art_preciov'], 1, 0, 'C', 1);
            $pdf->Cell(40,5,$a['tipo_cod']."-".$a['tipo_descri'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
        }else{
            $pdf->Cell(0, 0, "No se han registrado articulos...", 1, 0, 'L', 1);
        }
       
        


//SALIDA AL NAVEGADOR
$pdf->Output('reporte_artiaulo.pdf', 'I');
?>
