<?php
$serverName = "localhost";
$username = "root";
$password = "";
$db="costodevida";
$con = mysqli_connect($serverName,$username,$password,$db);
require_once 'Classes/PHPExcel.php';
require_once 'mostrar.php';
require_once 'excel.php';
activeErrorReporting();
noCli();
$sql = "SELECT * FROM gastos";
$resultado = mysqli_query($con,$sql);
$fila = 7; //Establecemos en que fila inciara a imprimir los datos


	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Proyecto")->setDescription("Reporte de los Gastos");
	

	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("GASTOS");
	

	
	$estiloTituloReporte = array(
		'font' => array(
		'name'      => 'Arial',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>13
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
		),
		'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		$estiloTituloColumnas = array(
		'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => 'FFFFFF'
		)
		),
		'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '538DD5')
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray( array(
		'font' => array(
		'name'  => 'Arial',
		'color' => array(
		'rgb' => '000000'
		)
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		));
		
		$objPHPExcel->getActiveSheet()->getStyle('G1:J5')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('G6:J6')->applyFromArray($estiloTituloColumnas);
		
		$objPHPExcel->getActiveSheet()->setCellValue('G3', 'REPORTE DE LOS GASTOS');
		$objPHPExcel->getActiveSheet()->mergeCells('G3:J3');
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$objPHPExcel->getActiveSheet()->setCellValue('G6', 'ID');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('H6', 'TIPO DE GASTO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('I6', 'FECHA GASTO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('J6', 'VALOR DEL GASTO');
	
$i = 2;
while($rows = $resultado->fetch_assoc())
{
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('G'.$fila, $rows['id_gastos'])
->setCellValue('H'.$fila, $rows['tipo_gastos'])
->setCellValue('I'.$fila, $rows['fecha_gastos'])
->setCellValue('J'.$fila, $rows['valor_gastos']);

$fila++; //Sumamos 1 para pasar a la siguiente fila
}
$fila = $fila-1;
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "G7:J".$fila);
	
	$filaGrafica = $fila+2;
	// definir origen de los valores
	$values = new PHPExcel_Chart_DataSeriesValues('Number', 'reporte!$G$7:$G$'.$fila);
	
	// definir origen de los rotulos
	$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Gastos!$H$7:$H$'.$fila);
	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setTitle('Gastos');

$objPHPExcel->setActiveSheetIndex(0);

getHeaders();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Gastos.xlsx"');

	ob_end_clean();
	$objWriter->save('php://output');

exit;