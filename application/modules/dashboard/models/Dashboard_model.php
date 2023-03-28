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
					$this->deleteEstudios($id_candidato);
					$bachiller = $this->input->post('cbox5');
					$tecnica = $this->input->post('cbox6');
					$tecnologia = $this->input->post('cbox7');
					$tecnologiaEspecializada = $this->input->post('cbox8');
					$universitaria = $this->input->post('cbox9');
					$especializacion = $this->input->post('cbox10');
					$maestria = $this->input->post('cbox11');
					$doctorado = $this->input->post('cbox12');
					if (!empty($bachiller)) {
						if ($bachiller == 'on') {
							$cbox5 = 1;
						} else {
							$cbox5 = 0;
						}
					} else {
						$cbox5 = 0;
					}
					if (!empty($tecnica)) {
						if ($tecnica == 'on') {
							$cbox6 = 1;
						} else {
							$cbox6 = 0;
						}
					} else {
						$cbox6 = 0;
					}
					if (!empty($tecnologia)) {
						if ($tecnologia == 'on') {
							$cbox7 = 1;
						} else {
							$cbox7 = 0;
						}
					} else {
						$cbox7 = 0;
					}
					if (!empty($tecnologiaEspecializada)) {
						if ($tecnologiaEspecializada == 'on') {
							$cbox8 = 1;
						} else {
							$cbox8 = 0;
						}
					} else {
						$cbox8 = 0;
					}
					if (!empty($universitaria)) {
						if ($universitaria == 'on') {
							$cbox9 = 1;
						} else {
							$cbox9 = 0;
						}
					} else {
						$cbox9 = 0;
					}
					if (!empty($especializacion)) {
						if ($especializacion == 'on') {
							$cbox10 = 1;
						} else {
							$cbox10 = 0;
						}
					} else {
						$cbox10 = 0;
					}
					if (!empty($maestria)) {
						if ($maestria == 'on') {
							$cbox11 = 1;
						} else {
							$cbox11 = 0;
						}
					} else {
						$cbox11 = 0;
					}
					if (!empty($doctorado)) {
						if ($doctorado == 'on') {
							$cbox12 = 1;
						} else {
							$cbox12 = 0;
						}
					} else {
						$cbox12 = 0;
					}
					$data = array(
						'fk_id_candidato' => $id_candidato,
						'bachiller' => $cbox5,
						'tecnica' => $cbox6,
						'tecnologia' => $cbox7,
						'tecnologia_especializada' => $cbox8,
						'universitaria' => $cbox9,
						'especializacion' => $cbox10,
						'maestria' => $cbox11,
						'doctorado' => $cbox12
					);
					$query3 = $this->db->insert('candidatos_puntajes_estudios_adicionales', $data);
					if ($query3) {
						return true;
					} else {
						return false;
					}
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

		public function deleteEstudios($id_candidato) {
			$this->db->where('fk_id_candidato', $id_candidato);
			$query = $this->db->delete('candidatos_puntajes_estudios_adicionales');
		}

		/**
		 * Consultar experiencia en el sector privado
		 * @since 27/03/2023
		 */
		public function get_privado($arrData)
		{
			$this->db->select();
			$this->db->where('fk_id_candidato_pr', $arrData['idCandidato']);
			$query = $this->db->get('candidatos_puntajes_sector_privado');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}

		/**
		 * Consultar experiencia en el sector publico
		 * @since 27/03/2023
		 */
		public function get_publico($arrData)
		{
			$this->db->select();
			$this->db->where('fk_id_candidato_pu', $arrData['idCandidato']);
			$query = $this->db->get('candidatos_puntajes_sector_publico');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}

		/**
		 * Save sector privado
		 * @since 29/4/2021
		 */
		public function savePrivado($arrParam)
		{
			$data = array(
				'fk_id_candidato_pr' => $arrParam['IdCandidato'],
				'entidad_pr' => $arrParam['entidadPr'],
				'fecha_inicio_pr' => $arrParam['fechaInicioPr'],
				'fecha_final_pr' => $arrParam['fechaFinalPr'],
				'anios_pr' => $arrParam['aniosPr'],
				'meses_pr' => $arrParam['mesesPr'],
				'dias_pr' => $arrParam['diasPr']
			);
			$query = $this->db->insert('candidatos_puntajes_sector_privado', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Save sector publico
		 * @since 29/4/2021
		 */
		public function savePublico($arrParam)
		{
			$data = array(
				'fk_id_candidato_pu' => $arrParam['IdCandidato'],
				'entidad_pu' => $arrParam['entidadPu'],
				'fecha_inicio_pu' => $arrParam['fechaInicioPu'],
				'fecha_final_pu' => $arrParam['fechaFinalPu'],
				'anios_pu' => $arrParam['aniosPu'],
				'meses_pu' => $arrParam['mesesPu'],
				'dias_pu' => $arrParam['diasPu']
			);
			$query = $this->db->insert('candidatos_puntajes_sector_publico', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Save sector publico
		 * @since 29/4/2021
		 */
		public function eliminarRegistro($tipo, $id)
		{
			if ($tipo == 'pr') {
				$this->db->where('id_privado', $id);
				$query = $this->db->delete('candidatos_puntajes_sector_privado');
			}
			if ($tipo == 'pu') {
				$this->db->where('id_publico', $id);
				$query = $this->db->delete('candidatos_puntajes_sector_publico');
			}
			return true;
		}
	}