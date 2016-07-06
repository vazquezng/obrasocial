<?php
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	require_once(dirname(__FILE__).'/../../core/autoload.php');
	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	//Variables por GET
	$idProvider = $_GET['idPrestador'];
	$month = $_GET['mes'];

	$prestador = new \controller\PrestadoresController();
	$liquidacion = $prestador->liquidacion($idProvider, $month);

    ob_start();
    include(dirname('__FILE__').'/res/liquidacion_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Liquidacion.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
