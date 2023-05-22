<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("reportes_model");
		$this->load->library('PHPExcel.php');
    }
	
	/**
	 * Generate Reportes in XLS
     * @since 3/09/2021
     * @author BMOTTAG
	 */		
	public function generaReporteFinalXLS($idProceso)
	{				
			//Candidatos activos
			$arrParam = array(
				'idProceso' => $idProceso,
				'estadoCandidato' => 1
			);
			$infoCandidatos = $this->reportes_model->get_candidatos_info($arrParam);
			//pr($infoCandidatos); exit;
			// Create new PHPExcel object	
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'INFORME FINAL');
			$objPHPExcel->getActiveSheet()
										->setCellValue('A2', 'Dependencia')
										->setCellValue('B2', 'Proceso')
										->setCellValue('C2', 'Nombres')
										->setCellValue('D2', 'Documento')
										->setCellValue('E2', 'Edad')
										->setCellValue('F2', 'Profesión')
										->setCellValue('G2', 'Grupo')
										->setCellValue('H2', 'Experiencia Profesional')
										->setCellValue('I2', 'Estudios Adicionales')
										->setCellValue('J2', 'Prueba Psicotécnica')
										->setCellValue('K2', 'Entrevista')
										->setCellValue('L2', 'Criterio Diferencial/Inclusión')
										->setCellValue('M2', 'Criterio Dif. Desarrollo Objetivo')
										->setCellValue('N2', 'Puntaje Total')
										->setCellValue('O2', '% Total');
			$j=3;
			if($infoCandidatos){
				foreach ($infoCandidatos as $info):
					$puntajeTotal = $info['puntaje_experiencia'] + $info['puntaje_adicionales'] + $info['resultado_prueba_psicotecnica'] + $info['resultado_entrevista'] + $info['criterio_etnias'] + $info['criterio_desarrollo'];
                    $porcetajeExperiencia = $info['puntaje_experiencia'] * 20 / 70;
                    $porcentajePsicotecnica = $info['resultado_prueba_psicotecnica'] * 20 / 90;
                    $porcentajeEntrevista = $info['resultado_entrevista'] * 30 / 80;
                    $porcentajeTotal = $porcetajeExperiencia + $info['puntaje_adicionales'] + $porcentajePsicotecnica + $porcentajeEntrevista + $info['criterio_etnias'] + $info['criterio_desarrollo'];
					$objPHPExcel->getActiveSheet()
								->setCellValue('A'.$j, $info['dependencia'])
								->setCellValue('B'.$j, $info['numero_proceso'])
								->setCellValue('C'.$j, $info['nombres'] .' '. $info['apellidos'])
								->setCellValue('D'.$j, $info['numero_identificacion'])
								->setCellValue('E'.$j, $info['edad'])
								->setCellValue('F'.$j, $info['profesion'])
								->setCellValue('G'.$j, $info['tipo_proceso'])
								->setCellValue('H'.$j, number_format($info['puntaje_experiencia'],1))
								->setCellValue('I'.$j, number_format($info['puntaje_adicionales'],1))
								->setCellValue('J'.$j, number_format($info['resultado_prueba_psicotecnica'],1))
								->setCellValue('K'.$j, number_format($info['resultado_entrevista'],1))
								->setCellValue('L'.$j, number_format($info['criterio_etnias'],1))
								->setCellValue('M'.$j, number_format($info['criterio_desarrollo'],1))
								->setCellValue('N'.$j, number_format($puntajeTotal,2))
								->setCellValue('O'.$j, number_format($porcentajeTotal,1));
					$j++;
				endforeach;
			}
			// Set column widths							  
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			// Add conditional formatting
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Informe Final');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="informe_final.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
    }

    /**
	 * Buscar Reporte General por Fechas
     * @since 15/05/2023
     * @author AOCUBILLOSA
	 */		
	public function buscarReporte()
	{
			$data["view"] = "buscar_reporte";
			$this->load->view("layout", $data);
	}

	/**
	 * Reporte General
     * @since 15/05/2023
     * @author AOCUBILLOSA
	 */
	public function descargarReporteGeneral()
	{				
			$arrParam = array(
				'desde' => $this->input->post("fecha_desde"),
				'hasta' => $this->input->post("fecha_hasta")
			);
			$infoReporte = $this->reportes_model->get_reporte_general($arrParam);
			// Create new PHPExcel object	
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REPORTE GENERAL');
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Fecha Proceso')
										->setCellValue('B2', 'Número Proceso')
										->setCellValue('C2', 'Tipo Proceso')
										->setCellValue('D2', 'Dependencia')
										->setCellValue('E2', 'Nombre')
										->setCellValue('F2', 'Documento')
										->setCellValue('G2', 'Profesión');
			$j=3;
			if($infoReporte){
				foreach ($infoReporte as $lista):
					$objPHPExcel->getActiveSheet()
										->setCellValue('A'.$j, $lista['fecha_registro_proceso'])
										->setCellValue('B'.$j, $lista['numero_proceso'])
										->setCellValue('C'.$j, $lista['tipo_proceso'])
										->setCellValue('D'.$j, $lista['dependencia'])
										->setCellValue('E'.$j, $lista['nombres'] .' '. $lista['apellidos'])
										->setCellValue('F'.$j, $lista['numero_identificacion'])
										->setCellValue('G'.$j, $lista['profesion']);
					$j++;
				endforeach;
			}
			// Set column widths
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
			// Add conditional formatting
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Reporte General');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="reporte_general.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
    }
}