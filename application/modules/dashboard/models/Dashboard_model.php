<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard_model extends CI_Model {

		
		/**
		 * Add/Edit Puntajes
		 * @since 29/4/2021
		 */
		public function savePuntajes($puntajeDirecto, $puntajeT) 
		{
				$idPuntaje = $this->input->post('hddIdPuntaje');
				$id_candidato = $this->input->post('hddIdCandidato');

				$data = array(
					'puntaje_experiencia' => $this->input->post('puntajeExperiencia'),
					'puntaje_adicionales' => $this->input->post('puntajeEstudiosAdicionales'),
					'resultado_prueba_psicotecnica' => $puntajeT,
					'resultado_entrevista' => $this->input->post('reultadoEntrevista'),
					'criterio_etnias' => $this->input->post('criterioEtnias'),
					'criterio_desarrollo' => $this->input->post('criterioDesarrollo'),
					'puntaje_directo' => $puntajeDirecto,
					'puntaje_t' => $puntajeT
				);	

				//revisar si es para adicionar o editar
				if ($idPuntaje == '')
				{
					$data['fk_id_candidato_p'] = $id_candidato;
					$data['fecha_registro_puntaje'] = date('Y-m-d');
					$query = $this->db->insert('candidatos_puntajes', $data);
				} else {
					$this->db->where('id_puntaje', $idPuntaje);
					$query = $this->db->update('candidatos_puntajes', $data);
				}
				if ($query) {
					$this->deleteCriterio($id_candidato);
					$etnias = $this->input->post('cbox1');
					$lgtbi = $this->input->post('cbox2');
					$discapacidad = $this->input->post('cbox3');
					$na = $this->input->post('cbox4');
					if (!empty($etnias)) {
						if ($etnias == 'on') {
							$cbox1 = 1;
						} else {
							$cbox1 = 0;
						}
					} else {
						$cbox1 = 0;
					}
					if (!empty($lgtbi)) {
						if ($lgtbi == 'on') {
							$cbox2 = 1;
						} else {
							$cbox2 = 0;
						}
					} else {
						$cbox2 = 0;
					}
					if (!empty($discapacidad)) {
						if ($discapacidad == 'on') {
							$cbox3 = 1;
						} else {
							$cbox3 = 0;
						}
					} else {
						$cbox3 = 0;
					}
					if (!empty($na)) {
						if ($na == 'on') {
							$cbox4 = 1;
						} else {
							$cbox4 = 0;
						}
					} else {
						$cbox4 = 0;
					}
					$data = array(
						'fk_id_candidato' => $id_candidato,
						'etnias' => $cbox1,
						'lgtbi' => $cbox2,
						'discapacidad' => $cbox3,
						'na' => $cbox4
					);
					$query2 = $this->db->insert('candidatos_puntajes_diferencial_inclusion', $data);
					if ($query2) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
		}
		
		public function deleteCriterio($id_candidato) {
			$this->db->where('fk_id_candidato', $id_candidato);
			$query = $this->db->delete('candidatos_puntajes_diferencial_inclusion');
		}
	}