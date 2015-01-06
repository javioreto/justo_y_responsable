<?php

$formato=$_REQUEST['formato'];

/* 
* Obtención de datos
*/

//Usuarios dados de alta
	$coments = Load::loadUserStats(date("m"),date("Y"));
	$b4=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadUserStats($mes,$ano);
	$c4=sizeOf($coments);

	$coments = Load::loadUserValidNoAdmin();
	$d4=sizeOf($coments);
	
	
//Establecimiento dados de alta
	$coments = Load::loadEstStats(date("m"),date("Y"));
	$b5=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadEstStats($mes,$ano);
	$c5=sizeOf($coments);

	$coments = Load::loadAllEstablishment();
	$d5=sizeOf($coments);


//Eventos dados de alta
	$coments = Load::loadEventsStats(date("m"),date("Y"));
	$b6=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadEventsStats($mes,$ano);
	$c6=sizeOf($coments);

	$coments = Load::loadAllEvents();
	$d6=sizeOf($coments);


//Productos dados de alta
	$coments = Load::loadProdStats(date("m"),date("Y"));
	$b7=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadProdStats($mes,$ano);
	$c7=sizeOf($coments);

	$coments = Load::loadProductsStats();
	$d7=sizeOf($coments);

//Busquedas de establecimientos
				$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
				$b8=$cont;
				
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
				$c8=$cont;

				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
				$d8=$cont;

//Busquedas de eventos
				$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
				$b9=$cont;
				
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
				$c9=$cont;

				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
				$d9=$cont;

//Busquedas de productos
				$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
				$b10=$cont;
				
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
				$c10=$cont;

				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
				$d10=$cont;

//Número de comentarios
	$coments = Load::loadComentStats(date("m"),date("Y"));
	$b11=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadComentStats($mes,$ano);
	$c11=sizeOf($coments);

	$coments = Load::loadComentsStats();
	$d11=sizeOf($coments);

//Número de accesos a la aplicación
	$coments = Load::loadAccesoStats(date("m"),date("Y"));
	$b12=sizeOf($coments);
					
	$datos = Load::obtenerAnoMes(date("m"),date("Y"));
	$mes=$datos[0];
	$ano=$datos[1];
	
	$coments = Load::loadAccesoStats($mes,$ano);
	$c12=sizeOf($coments);

	$coments = Load::loadAccesosStats();
	$d12=sizeOf($coments);



/*
* Exportar a formato XLSX // ODS
*
*/

if($formato==1 || $formato==2){

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Sistema de exportación de estadísticas")
							 ->setLastModifiedBy("Sistema de exportación de estadísticas")
							 ->setTitle("Resumen estadístico")
							 ->setSubject("Resumen estadístico - justo y responsable")
							 ->setDescription("Resumen de los datos estadísticos extraidos de la aplicación justo y responsable")
							 ->setKeywords("Resumen estadístico")
							 ->setCategory("Resumen estadístico");


// cabecera
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Resumen estadístico general')
            ->setCellValue('D1', 'Fecha: '.DATE("m").'-'.DATE("Y"))
            ->setCellValue('A3', 'Concepto')
            ->setCellValue('B3', 'Este mes')
            ->setCellValue('C3', 'Último mes')
            ->setCellValue('D3', 'Histórico');

// conceptos
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Usuarios dados de alta')
            ->setCellValue('A5', 'Establecimiento dados de alta')
            ->setCellValue('A6', 'Eventos dados de alta')
            ->setCellValue('A7', 'Productos dados de alta')
            ->setCellValue('A8', 'Busquedas de establecimientos')
            ->setCellValue('A9', 'Busquedas de eventos')
            ->setCellValue('A10', 'Busquedas de productos')
            ->setCellValue('A11', 'Número de comentarios')
            ->setCellValue('A12', 'Número de accesos a la aplicación');
      
// mes
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B4', $b4)
            ->setCellValue('B5', $b5)
            ->setCellValue('B6', $b6)
            ->setCellValue('B7', $b7)
            ->setCellValue('B8', $b8)
            ->setCellValue('B9', $b9)
            ->setCellValue('B10', $b10)
            ->setCellValue('B11', $b11)
            ->setCellValue('B12', $b12);

// mes anterior
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', $c4)
            ->setCellValue('C5', $c5)
            ->setCellValue('C6', $c6)
            ->setCellValue('C7', $c7)
            ->setCellValue('C8', $c8)
            ->setCellValue('C9', $c9)
            ->setCellValue('C10', $c10)
            ->setCellValue('C11', $c11)
            ->setCellValue('C12', $c12);

// historico
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D4', $d4)
            ->setCellValue('D5', $d5)
            ->setCellValue('D6', $d6)
            ->setCellValue('D7', $d7)
            ->setCellValue('D8', $d8)
            ->setCellValue('D9', $d9)
            ->setCellValue('D10', $d10)
            ->setCellValue('D11', $d11)
            ->setCellValue('D12', $d12);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Resumen estadistico');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
	if($formato==1){
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Resumen-estadistico-'.DATE("m").'-'.DATE("Y").'.xlsx"');
	}else{
header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
header('Content-Disposition: attachment;filename="Resumen-estadistico-'.DATE("m").'-'.DATE("Y").'.ods"');	
	}
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
	if($formato==1){
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	}else{
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'OpenDocument');
	}
$objWriter->save('php://output');
exit;

}



/*
* Exportar a formato PDF
*
*/

if($formato==3){

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


//	Change these values to select the Rendering library that you wish to use
//		and its directory location on your server
//$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
//$rendererLibrary = 'tcPDF5.9';
//$rendererLibrary = 'dompdf';
$rendererLibrary = 'dompdf';
$rendererLibraryPath = dirname(__FILE__).'/../Classes/PHPExcel/Writer/' . $rendererLibrary;


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Sistema de exportación de estadísticas")
							 ->setLastModifiedBy("Sistema de exportación de estadísticas")
							 ->setTitle("Resumen estadístico")
							 ->setSubject("Resumen estadístico - justo y responsable")
							 ->setDescription("Resumen de los datos estadísticos extraidos de la aplicación justo y responsable")
							 ->setKeywords("Resumen estadístico")
							 ->setCategory("Resumen estadístico");


// cabecera
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Resumen estadístico general')
            ->setCellValue('D1', 'Fecha: '.DATE("m").'-'.DATE("Y"))
            ->setCellValue('A3', 'Concepto')
            ->setCellValue('B3', 'Este mes')
            ->setCellValue('C3', 'Último mes')
            ->setCellValue('D3', 'Histórico');

// conceptos
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Usuarios dados de alta')
            ->setCellValue('A5', 'Establecimiento dados de alta')
            ->setCellValue('A6', 'Eventos dados de alta')
            ->setCellValue('A7', 'Productos dados de alta')
            ->setCellValue('A8', 'Busquedas de establecimientos')
            ->setCellValue('A9', 'Busquedas de eventos')
            ->setCellValue('A10', 'Busquedas de productos')
            ->setCellValue('A11', 'Número de comentarios')
            ->setCellValue('A12', 'Número de accesos a la aplicación');
      
// mes
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B4', $b4)
            ->setCellValue('B5', $b5)
            ->setCellValue('B6', $b6)
            ->setCellValue('B7', $b7)
            ->setCellValue('B8', $b8)
            ->setCellValue('B9', $b9)
            ->setCellValue('B10', $b10)
            ->setCellValue('B11', $b11)
            ->setCellValue('B12', $b12);

// mes anterior
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', $c4)
            ->setCellValue('C5', $c5)
            ->setCellValue('C6', $c6)
            ->setCellValue('C7', $c7)
            ->setCellValue('C8', $c8)
            ->setCellValue('C9', $c9)
            ->setCellValue('C10', $c10)
            ->setCellValue('C11', $c11)
            ->setCellValue('C12', $c12);

// historico
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D4', $d4)
            ->setCellValue('D5', $d5)
            ->setCellValue('D6', $d6)
            ->setCellValue('D7', $d7)
            ->setCellValue('D8', $d8)
            ->setCellValue('D9', $d9)
            ->setCellValue('D10', $d10)
            ->setCellValue('D11', $d11)
            ->setCellValue('D12', $d12);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->getActiveSheet()->setShowGridLines(false);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
	)) {
	die(
		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		'<br />' .
		'at the top of this script as appropriate for your directory structure'
	);
}


// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="Resumen-estadistico-'.DATE("m").'-'.DATE("Y").'.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
}


?>
