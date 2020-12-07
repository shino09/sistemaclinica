<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Exportar_model extends CI_Model {
    
    function __construct(){
        
        parent::__construct();
        
        #libreria PHPExcel en libraries
		require APPPATH."libraries/Excel/PHPExcel.php";
    }
    
    public function estilos(){
        
        $estilos->styleDerecha = array(
            'font' => array(
                'bold' => true,
				 'italic' => false,
				 'strike' => false,
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
			)
		);

        $estilos->styleIzquierda = array(
            'font' => array(
                'bold' => true,
				 'italic' => false,
				 'strike' => false,
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
			)
		);

        $estilos->styleCentro = array(
            'font' => array(
                'bold' => true,
				 'italic' => false,
				 'strike' => false,
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
		);

		$estilos->styleFondo = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            )
		);

        $estilos->styleFondo1 = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'ffff99')
			),
		);

        $estilos->styleFondo2 = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'ffff00')
			),
		);


		$estilos->styleFont = array(
			 'font'    => array(
				 'bold'      => true,
				 'italic'    => false,
				 'strike'    => false,
			 ),
			'alignment' => array(
					'wrap'       => true,
			  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
		);
        
        return $estilos;
        
    }
    
    public function excel_estado($ejecutivos){
        
        $objPHPExcel = new PHPExcel();
		$objPHPExcel->
			getProperties()
				->setCreator("aeurus.cl")
				->setLastModifiedBy("aeurus.cl")
				->setTitle("Graficos Estados")
				->setSubject("Graficos Estados")
				->setDescription("Graficos Estados")
				->setKeywords("Graficos Estados")
				->setCategory("reportes");
        
        #setea los estilos
        $estilos = $this->estilos();
        $styleDerecha = $estilos->styleDerecha;
        $styleIzquierda = $estilos->styleIzquierda;
        $styleCentro = $estilos->styleCentro;
        $styleFondo = $estilos->styleFondo;
        $styleFondo1 = $estilos->styleFondo1;
        $styleFondo2 = $estilos->styleFondo2;
        $styleFont = $estilos->styleFont;
        
        
        foreach($ejecutivos as $index=>$aux){
            
            $objWorkSheet = $objPHPExcel->createSheet($index);
            $objPHPExcel->setActiveSheetIndex($index);
            
            #ancho de las columnas
            $objWorkSheet->getColumnDimension('A')->setWidth(1);
            $objWorkSheet->getColumnDimension('B')->setWidth(20);
            $objWorkSheet->getColumnDimension('C')->setWidth(20);
            $objWorkSheet->getColumnDimension('D')->setWidth(20);
            $objWorkSheet->getColumnDimension('E')->setWidth(20);
            $objWorkSheet->getColumnDimension('F')->setWidth(20);
    
            #titulo
            $objWorkSheet->mergeCells('B1:F2');
            
    		$objWorkSheet->setCellValue('B3', 'Gráficos Ejecutivo: '.$aux->nombre.' '.$aux->primer_apellido.' '.$aux->segundo_apellido);
    		$objWorkSheet->getStyle('B3:G3')->applyFromArray($styleCentro);
            $objWorkSheet->mergeCells('B3:F4');
            #fin titulo
            
            
            #filtro fecha
    		$objWorkSheet->setCellValue('B6', 'FILTRO FECHA');
    		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleFondo1);
    		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleIzquierda);
            $objWorkSheet->mergeCells('B6:C6');
    
    		$objWorkSheet->setCellValue('D6', formatearFecha($aux->fecha_desde,'','/').' - '.formatearFecha($aux->fecha_hasta,'','/'));
    		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleFondo1);
    		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleIzquierda);
            $objWorkSheet->mergeCells('D6:F6');
            #fin filtro fecha
            
            
            #linea en blanco (separacion)
    		$objWorkSheet->setCellValue('B7', '');
            $objWorkSheet->mergeCells('B7:F7');
            #fin linea en blanco (separacion)
            
            
            if($aux->datos){
                $i = 8;
                foreach($aux->datos as $dat){
                    $letra = 'B';
                    
                    #tabla datos
            		$objWorkSheet->setCellValue($letra.$i, $dat->nombre);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo1);
            		$objPHPExcel->getActiveSheet()->getStyle($letra++.$i)->applyFromArray($styleIzquierda);
            
            		$objWorkSheet->setCellValue($letra.$i, $dat->cantidad);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleIzquierda);
                    #fin tabla datos
                    
                    $i++;
                }
            }
            
            #agrega el titulo
            $objPHPExcel->getActiveSheet()->setTitle($aux->nombre.' '.$aux->primer_apellido);
            
            
            #agrega el logo de suractivo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = $_SERVER['DOCUMENT_ROOT'].'/imagenes/template/logo.png';
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(8);
            $objDrawing->setCoordinates('B1');
            $objDrawing->setHeight(75);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        }
        
        $objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Excel Gráficos Estados - '.date('d/m/Y').'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
        
    }
    
    
    public function excel_ejecutivos($estados){
        
        $objPHPExcel = new PHPExcel();
		$objPHPExcel->
			getProperties()
				->setCreator("aeurus.cl")
				->setLastModifiedBy("aeurus.cl")
				->setTitle("Graficos Ejecutivos")
				->setSubject("Graficos Ejecutivos")
				->setDescription("Graficos Ejecutivos")
				->setKeywords("Graficos Ejecutivos")
				->setCategory("reportes");
        
        #setea los estilos
        $estilos = $this->estilos();
        $styleDerecha = $estilos->styleDerecha;
        $styleIzquierda = $estilos->styleIzquierda;
        $styleCentro = $estilos->styleCentro;
        $styleFondo = $estilos->styleFondo;
        $styleFondo1 = $estilos->styleFondo1;
        $styleFondo2 = $estilos->styleFondo2;
        $styleFont = $estilos->styleFont;
        
        foreach($estados as $index=>$aux){
            
            $objWorkSheet = $objPHPExcel->createSheet($index);
            $objPHPExcel->setActiveSheetIndex($index);
            
            #ancho de las columnas
            $objWorkSheet->getColumnDimension('A')->setWidth(1);
            $objWorkSheet->getColumnDimension('B')->setWidth(20);
            $objWorkSheet->getColumnDimension('C')->setWidth(20);
            $objWorkSheet->getColumnDimension('D')->setWidth(20);
            $objWorkSheet->getColumnDimension('E')->setWidth(20);
            $objWorkSheet->getColumnDimension('F')->setWidth(20);
    
            #titulo
            $objWorkSheet->mergeCells('B1:F2');
            
    		$objWorkSheet->setCellValue('B3', 'Gráficos Estado '.$aux->nombre);
    		$objWorkSheet->getStyle('B3:G3')->applyFromArray($styleCentro);
            $objWorkSheet->mergeCells('B3:F4');
            #fin titulo
            
            
            #filtro fecha
    		$objWorkSheet->setCellValue('B6', 'FILTRO FECHA');
    		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleFondo1);
    		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleIzquierda);
            $objWorkSheet->mergeCells('B6:C6');
    
    		$objWorkSheet->setCellValue('D6', formatearFecha($aux->fecha_desde,'','/').' - '.formatearFecha($aux->fecha_hasta,'','/'));
    		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleFondo1);
    		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleIzquierda);
            $objWorkSheet->mergeCells('D6:F6');
            #fin filtro fecha
            
            
            #linea en blanco (separacion)
    		$objWorkSheet->setCellValue('B7', '');
            $objWorkSheet->mergeCells('B7:F7');
            #fin linea en blanco (separacion)
            
            
            if($aux->datos){
                $i = 8;
                foreach($aux->datos as $dat){
                    $letra = 'B';
                    
                    #tabla datos
            		$objWorkSheet->setCellValue($letra.$i, $dat->nombre);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo1);
            		$objPHPExcel->getActiveSheet()->getStyle($letra++.$i)->applyFromArray($styleIzquierda);
            
            		$objWorkSheet->setCellValue($letra.$i, $dat->cantidad);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo);
            		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleIzquierda);
                    #fin tabla datos
                    
                    $i++;
                }
            }
            
            #agrega el titulo
            $objPHPExcel->getActiveSheet()->setTitle($aux->nombre);
            
            #agrega el logo de suractivo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = $_SERVER['DOCUMENT_ROOT'].'/imagenes/template/logo.png';
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(8);
            $objDrawing->setCoordinates('B1');
            $objDrawing->setHeight(75);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        }
        
        $objPHPExcel->setActiveSheetIndex(0);
        
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Excel Gráficos Ejecutivos - '.date('d/m/Y').'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
        
    }
    
    
    public function excel_cotizaciones($estados, $filtros){
        
        $objPHPExcel = new PHPExcel();
		$objPHPExcel->
			getProperties()
				->setCreator("aeurus.cl")
				->setLastModifiedBy("aeurus.cl")
				->setTitle("Graficos Cotizaciones")
				->setSubject("Graficos Cotizaciones")
				->setDescription("Graficos Cotizaciones")
				->setKeywords("Graficos Cotizaciones")
				->setCategory("reportes");
        
        #setea los estilos
        $estilos = $this->estilos();
        $styleDerecha = $estilos->styleDerecha;
        $styleIzquierda = $estilos->styleIzquierda;
        $styleCentro = $estilos->styleCentro;
        $styleFondo = $estilos->styleFondo;
        $styleFondo1 = $estilos->styleFondo1;
        $styleFondo2 = $estilos->styleFondo2;
        $styleFont = $estilos->styleFont;
        
        
        $objWorkSheet = $objPHPExcel->createSheet(0);
        $objPHPExcel->setActiveSheetIndex(0);
        
        #ancho de las columnas
        $objWorkSheet->getColumnDimension('A')->setWidth(1);
        $objWorkSheet->getColumnDimension('B')->setWidth(20);
        $objWorkSheet->getColumnDimension('C')->setWidth(20);
        $objWorkSheet->getColumnDimension('D')->setWidth(20);
        $objWorkSheet->getColumnDimension('E')->setWidth(20);
        $objWorkSheet->getColumnDimension('F')->setWidth(20);

        #titulo
        $objWorkSheet->mergeCells('B1:F2');
        
		$objWorkSheet->setCellValue('B3', 'Gráficos Cotizaciones');
		$objWorkSheet->getStyle('B3:G3')->applyFromArray($styleCentro);
        $objWorkSheet->mergeCells('B3:F4');
        #fin titulo
        
        
        #filtro fecha
		$objWorkSheet->setCellValue('B6', 'FILTRO FECHA');
		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleFondo1);
		$objPHPExcel->getActiveSheet()->getStyle('B6:C6')->applyFromArray($styleIzquierda);
        $objWorkSheet->mergeCells('B6:C6');

		$objWorkSheet->setCellValue('D6', formatearFecha($filtros->fecha_desde,'','/').' - '.formatearFecha($filtros->fecha_hasta,'','/'));
		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleFondo1);
		$objPHPExcel->getActiveSheet()->getStyle('D6:F6')->applyFromArray($styleIzquierda);
        $objWorkSheet->mergeCells('D6:F6');
        #fin filtro fecha
        
        
        #linea en blanco (separacion)
		$objWorkSheet->setCellValue('B7', '');
        $objWorkSheet->mergeCells('B7:F7');
        #fin linea en blanco (separacion)
        
        
        if($estados){
            $i = 8;
            foreach($estados as $dat){
                $letra = 'B';
                
                #tabla datos
        		$objWorkSheet->setCellValue($letra.$i, $dat->nombre);
        		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo1);
        		$objPHPExcel->getActiveSheet()->getStyle($letra++.$i)->applyFromArray($styleIzquierda);
        
        		$objWorkSheet->setCellValue($letra.$i, $dat->cantidad);
        		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo);
        		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleIzquierda);
                #fin tabla datos
                
                $i++;
            }
        }
        
        #tabla totales
        $letra = 'B';
		$objWorkSheet->setCellValue($letra.$i, 'Total');
		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo1);
		$objPHPExcel->getActiveSheet()->getStyle($letra++.$i)->applyFromArray($styleIzquierda);

		$objWorkSheet->setCellValue($letra.$i, $filtros->total_cotizaciones);
		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleFondo);
		$objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleIzquierda);
        #fin tabla totales
        
        #agrega el titulo
        $objPHPExcel->getActiveSheet()->setTitle('Cotizaciones');
        
        #agrega el logo de suractivo
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $logo = $_SERVER['DOCUMENT_ROOT'].'/imagenes/template/logo.png';
        $objDrawing->setPath($logo);
        $objDrawing->setOffsetX(8);
        $objDrawing->setCoordinates('B1');
        $objDrawing->setHeight(75);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Excel Gráficos Cotizaciones - '.date('d/m/Y').'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
        
    }
    
}