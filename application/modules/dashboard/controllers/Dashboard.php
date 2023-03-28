<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("general_model");
    }

	/**
	 * SUPER ADMIN DASHBOARD
	 */
	public function index()
	{				
		$arrParam = array('estadoProceso' => 1);
		$data['infoProcesos'] = $this->general_model->get_procesos_info($arrParam);
		$data["view"] = "dashboard";
		$this->load->view("layout_calendar", $data);
	}
		
	/**
	 * DETALLE de puntajes de candidatos por procesos
	 */
	public function detalle($idProceso)
	{			
		$arrParam = array('idProceso' => $idProceso);
		$data['infoProcesos'] = $this->general_model->get_procesos_info($arrParam);
	
		//Candidatos activos
		$arrParam = array(
			'idProceso' => $idProceso,
			'estadoCandidato' => 1
		);
		$data['infoCandidatos'] = $this->general_model->get_candidatos_info($arrParam);
		$data['infoCalculoCompetencias'] = $this->general_model->get_calculos_competencias($arrParam);

		$arrParam = array(
			'idProceso' => $idProceso,
			'estadoFormulario' => 1,
			'estadoCandidato' => 1
		);
		$data['infoCalculoFormHabilidades'] = $this->general_model->get_calculos_formulario_habilidades($arrParam);
		$data['infoCalculoFormAspectos'] = $this->general_model->get_calculos_formulario_aspectos($arrParam);

		$data["view"] = "detalle_pruebas";
		$this->load->view("layout_calendar", $data);
	}

	/**
	 * Lista de Respuestas
     * @since 29/3/2021
     * @author BMOTTAG
	 */
	public function respuestas_habilidades($idFormulario)
	{		
		$arrParam = array('idFormHabilidades' => $idFormulario);			
		$data['infoFormulario'] = $this->general_model->get_formulario_habilidades($arrParam);
		$data['infoRespuestas'] = $this->general_model->get_respuestas_formulario_habilidades($arrParam);
		$data['view'] ='respuestas_habilidades';
		$this->load->view('layout_calendar', $data);
	}

	/**
	 * Lista de Respuestas Fomrulario de Aspectos de interes
     * @since 10/4/2021
     * @author BMOTTAG
	 */
	public function respuestas_aspectos($idFormulario)
	{		
		$arrParam = array('idFormAspectos' => $idFormulario);			
		$data['infoFormulario'] = $this->general_model->get_formulario_aspectos($arrParam);
		$data['infoRespuestas'] = $this->general_model->get_respuestas_formulario_aspectos($arrParam);
		$data['view'] ='respuestas_aspectos';
		$this->load->view('layout_calendar', $data);
	}

	/**
     * Cargo modal - formulario de puntajes
     * @since 29/04/2021
     * @author BMOTTAG
     */
    public function cargarModalPuntajes()
	{
		header("Content-Type: text/plain; charset=utf-8");
		$data['infoPuntajes'] = FALSE;
		$data['idCandidato'] = $this->input->post('idCandidato');
		$data['idPuntaje'] = $this->input->post('idPuntaje');
		if ($data['idPuntaje'] != 'x')
		{
			$arrParam = array('idPuntaje' => $data['idPuntaje']);
			$data['infoPuntajes'] = $this->general_model->get_puntaje($arrParam);
			$data['idCandidato'] = $data['infoPuntajes'][0]['fk_id_candidato_p'];
			$arrParam = array('idCandidato' => $data['idCandidato']);
			$data['infoPrivado'] = $this->dashboard_model->get_privado($arrParam);
			$data['infoPublico'] = $this->dashboard_model->get_publico($arrParam);
		}
		$this->load->view('puntajes_modal', $data);
    }

	/**
	 * Save puntajes
     * @since 29/4/2021
     * @author BMOTTAG
	 */
	public function save_puntajes()
	{			
		header('Content-Type: application/json');
		$data = array();	
		$msj = "Se actualizó el Puntaje del Candidato!";
		$arrParam['idCandidato'] = $this->input->post('hddIdCandidato');
		$infoCandidatos = $this->general_model->get_candidatos_info($arrParam);
		$data["idProceso"] = $infoCandidatos[0]['fk_id_proceso'];
		//realizar calculo de escala T
		$infoHabilidades = $this->general_model->get_calculos_formulario_habilidades($arrParam);
		$infoAspectos = $this->general_model->get_calculos_formulario_aspectos($arrParam);
		$sumaFormHabilidades = 0;
		$sumaFormAspectos = 0;
		if($infoHabilidades){
			$sumaFormHabilidades = $infoHabilidades[0]['ASE'] + $infoHabilidades[0]['COM'] + $infoHabilidades[0]['AUT'] + $infoHabilidades[0]['TOM'];
		}
		if($infoAspectos){
			$sumaFormAspectos = $infoAspectos[0]['LOG'] + $infoAspectos[0]['DT'] + $infoAspectos[0]['SUP'] + $infoAspectos[0]['POD'] + $infoAspectos[0]['AA'] + $infoAspectos[0]['GT'] + $infoAspectos[0]['AFI'] + $infoAspectos[0]['ANV'] + $infoAspectos[0]['CT'] + $infoAspectos[0]['A-R'] + $infoAspectos[0]['REQ'] + $infoAspectos[0]['SAL'] + $infoAspectos[0]['REC'] + $infoAspectos[0]['EXP'] + $infoAspectos[0]['PRO'];
		}
		$puntajeDirecto = ($sumaFormHabilidades*2) + $sumaFormAspectos;
		$puntajeT = 0;
		if($puntajeDirecto > 0){
			$puntajeT = $puntajeDirecto*90/690; 
		}
		//fin calculo escala T
		if ($this->dashboard_model->savePuntajes($puntajeDirecto, $puntajeT)) 
		{
			$data["result"] = true;
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
    }
	
	/**
	 * Save sector privado
     * @since 27/03/2023
     * @author AOCUBILLOSA
	 */
	public function save_privado()
	{			
		header('Content-Type: application/json');
		$data = array();
		$msj = "Informacion guardada exitosamente.";
		$data['fecha_inicio_pr'] = $this->input->post('fechaInicioPr');
		$data['fecha_final_pr'] = $this->input->post('fechaFinalPr');
		$datos = $this->calcularTiempo($data['fecha_inicio_pr'], $data['fecha_final_pr']);
		$arrParam = array(
			'IdCandidato' => $this->input->post('hddIdCandidato'),
			'entidadPr' => $this->input->post('entidadPr'),
			'fechaInicioPr' => $this->input->post('fechaInicioPr'),
			'fechaFinalPr' => $this->input->post('fechaFinalPr'),
			'aniosPr' => $datos[0],
			'mesesPr' => $datos[1],
			'diasPr' => $datos[2]
		);
		if ($this->dashboard_model->savePrivado($arrParam))
		{
			$data["result"] = true;
			$data['idCandidato'] = $this->input->post('hddIdCandidato');
			$data['idPuntaje'] = $this->input->post('hddIdPuntaje');
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
    }

    /**
	 * Save sector publico
     * @since 27/03/2023
     * @author AOCUBILLOSA
	 */
	public function save_publico()
	{			
		header('Content-Type: application/json');
		$data = array();
		$msj = "Informacion guardada exitosamente.";
		$data['fecha_inicio_pu'] = $this->input->post('fechaInicioPu');
		$data['fecha_final_pu'] = $this->input->post('fechaFinalPu');
		$datos = $this->calcularTiempo($data['fecha_inicio_pu'], $data['fecha_final_pu']);
		$arrParam = array(
			'IdCandidato' => $this->input->post('hddIdCandidato'),
			'entidadPu' => $this->input->post('entidadPu'),
			'fechaInicioPu' => $this->input->post('fechaInicioPu'),
			'fechaFinalPu' => $this->input->post('fechaFinalPu'),
			'aniosPu' => $datos[0],
			'mesesPu' => $datos[1],
			'diasPu' => $datos[2]
		);
		if ($this->dashboard_model->savePublico($arrParam))
		{
			$data["result"] = true;
			$data['idCandidato'] = $this->input->post('hddIdCandidato');
			$data['idPuntaje'] = $this->input->post('hddIdPuntaje');
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
    }

    /**
	 * Eliminar registros
     * @since 27/03/2023
     * @author AOCUBILLOSA
	 */
	public function eliminar_registro()
	{			
		header('Content-Type: application/json');
		$data = array();
		$msj = "Registro eliminado exitosamente.";
		$identificador = explode('_', $this->input->post('identificador'));
		$tipo = $identificador[0];
		$id = $identificador[1];
		if ($this->dashboard_model->eliminarRegistro($tipo, $id)) {
			$data["result"] = true;
			$data['idCandidato'] = $this->input->post('idCandidato');
			$data['idPuntaje'] = $this->input->post('idPuntaje');
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
    }

    public function calcularTiempo($fechaInicio, $fechaFin){
    	$datetime1 = date_create($fechaInicio);
		$datetime2 = date_create($fechaFin);
		$intervalo = date_diff($datetime1, $datetime2);
		$tiempo = array();
		foreach($intervalo as $valor){
			$tiempo[] = $valor;
		}
		return $tiempo;
    }
}