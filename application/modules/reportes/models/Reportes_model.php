<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
		/**
		 * Consultar registros de procesos
		 * @since 19/3/2021
		 */
		public function get_procesos_info($arrData)
		{
				$this->db->select();
				$this->db->join('param_dependencias D', 'D.id_dependencia = P.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_proceso T', 'T.id_tipo_proceso = P.fk_id_tipo_proceso', 'INNER');
				if (array_key_exists("idProceso", $arrData)) {
					$this->db->where('P.id_proceso ', $arrData["idProceso"]);
				}
				if (array_key_exists("estadoProceso", $arrData)) {
					$this->db->where('P.estado_proceso', $arrData["estadoProceso"]);
				}
				$this->db->order_by('P.numero_proceso', 'asc');
				$query = $this->db->get('proceso P');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		public function get_candidatos_info($arrData)
		{
				$this->db->select();
				$this->db->join('candidatos_puntajes X', 'X.fk_id_candidato_p  = C.id_candidato', 'LEFT');
				$this->db->join('param_nivel_academico A', 'A.id_nivel_academico = C.fk_id_nivel_academico', 'INNER');
				$this->db->join('proceso P', 'P.id_proceso = C.fk_id_proceso', 'INNER');
				$this->db->join('param_dependencias PD', 'PD.id_dependencia = P.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_proceso T', 'T.id_tipo_proceso = P.fk_id_tipo_proceso', 'INNER');
				$this->db->join('param_divipola D', 'D.mpio_divipola = C.fk_mpio_divipola', 'INNER');
				if (array_key_exists("idCandidato", $arrData)) {
					$this->db->where('C.id_candidato', $arrData["idCandidato"]);
				}
				if (array_key_exists("numeroIdentificacion", $arrData)) {
					$this->db->where('C.numero_identificacion', $arrData["numeroIdentificacion"]);
				}
				if (array_key_exists("idProceso", $arrData)) {
					$this->db->where('C.fk_id_proceso', $arrData["idProceso"]);
				}
				if (array_key_exists("estadoCandidato", $arrData)) {
					$this->db->where('C.estado_candidato', $arrData["estadoCandidato"]);
				}
				$this->db->order_by('C.nombres, C.apellidos', 'asc');
				$query = $this->db->get('candidatos C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
	    public function get_reporte_general($arrData)
		{
				$this->db->select();
				$this->db->join('proceso P', 'P.id_proceso = C.fk_id_proceso', 'INNER');
				$this->db->join('param_dependencias D', 'D.id_dependencia = P.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_proceso T', 'T.id_tipo_proceso = P.fk_id_tipo_proceso', 'INNER');
				$this->db->where('P.fecha_registro_proceso between "'. $arrData['desde'] .'" AND "'. $arrData['hasta'] .'"');
				$this->db->order_by('P.fecha_registro_proceso', 'desc');
				$query = $this->db->get('candidatos C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	}