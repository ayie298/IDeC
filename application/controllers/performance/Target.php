<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/performance/performance_model');
		$this->load->model('idec_model');
	}

	public function edit($id = null)
	{
		$period = 'TW I';
		$periode = 1;

		if($_POST) {
			if($this->input->post('change_quartal')) {
				$quartal = $this->input->post('quartal');
				$periode = $quartal;

				switch ($quartal) {
				case '1':
					$period = 'TW I';
				break;
				case '2':
					$period = 'TW II';
				break;
				case '3':
					$period = 'TW III';
				break;
				case '4':
					$period = 'TW IV';
				break;
			}
			}

			if($this->input->post('submit_formula')) {
				switch ($this->input->post('tw')) {
				case '1':
					$period = 'TW I';
				break;
				case '2':
					$period = 'TW II';
				break;
				case '3':
					$period = 'TW III';
				break;
				case '4':
					$period = 'TW IV';
				break;
				}

				$perform 	= $this->performance_model->find('getItem', array('performance_system_item.id_performance_system_item' => $id));
				$formula1 	= $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $perform->id_performance_indicator));
				$formula2 	= $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $perform->id_performance_indicator));
				$target 	= $this->program_model->getTarget($perform->id_program, $period, 'row');
				$quartal 	= $this->performance_model->find('getQuartal', array('id_performance_system_item' => $perform->id_performance_system_item, 'period' => $this->input->post('tw')));

				$formula 	= $this->input->post('method') == 'manual' ? $this->input->post('real_percent') : $this->formula($formula2->name, $this->input->post('real'), $target->target);
				$batasAtas  = 105;
				$batasBawah = 60;

				if($formula > $batasAtas) {
					$achievement = 105;
				} elseif ($formula < $batasBawah) {
					$achievement = 60;
				} else {
					$achievement = $formula;
				}

				$weight = empty($quartal) ? 100 : $quartal->weight;

				$data = array(
					'target' 			=> 100,
					'achievement_raw'	=> $formula,
					'achievement'		=> $achievement,
					'deviation'			=> $achievement-100,
					'accomplishment'	=> $achievement*$weight,
				);

				$dataReal = array(
					'realization' => $this->input->post('real'),
				);

				$find = $this->db->where('id_performance_quartal', $this->input->post('id'))->get('performance_realization')->num_rows();

				if($this->input->post('id') == "") {
					$data['id_performance_quartal'] 	= $this->program_model->getAutoIncrement('performance_quartal', 'id_performance_quartal');
					$data['period']						= $this->input->post('tw');
					$data['id_performance_system_item'] = $id;

					$this->db->insert('performance_quartal', $data);

					$this->session->set_flashdata('notice', 'Formula has been added');
				} else {
					$this->db->where('id_performance_quartal', $this->input->post('id'));
					$this->db->update('performance_quartal', $data);

					$this->session->set_flashdata('notice', 'Formula has been updated');
				}

				if($find == 0) {
					$dataReal['id_performance_realization']	= $this->program_model->getAutoIncrement('performance_realization', 'id_performance_realization');
					$dataReal['id_performance_quartal']	 	= $this->input->post('id') == '' ? $data['id_performance_quartal'] : $this->input->post('id');

					$this->db->insert('performance_realization', $dataReal);
				} else {
					$this->db->where('id_performance_quartal', $this->input->post('id'));
					$this->db->update('performance_realization', $dataReal);
				}

				redirect(current_url());
			}
		}

		$data['performance'] = $this->performance_model->find('getItem', array('performance_system_item.id_performance_system_item' => $id));
		$data['program']	 = $this->program_model->find(array('id_program' => $data['performance']->id_program));
		$data['system']		 = $this->performance_model->find('getPerformance', array('id_performance_system' => $data['performance']->id_performance_system));
		$data['quartal']	 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $data['performance']->id_performance_system_item, 'period' => $periode));
		$data['target']		 = $this->program_model->getTarget($data['performance']->id_program, $period, 'row');
		$data['formula1']	 = $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $data['performance']->id_performance_indicator));
		$data['formula2'] 	 = $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $data['performance']->id_performance_indicator));
		$data['real']		 = $this->performance_model->find('getRealization', array('id_performance_quartal' => $data['quartal']->id_performance_quartal));
		$data['periode']	 = $periode;

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_target', $data);
		$this->template->render();
	}

	private function formula($name = "", $realisasi, $target)
	{
		//if($name == 'F1') {
			$count = ($realisasi-$target);
			$count = $count/$target;
			$count = $count+(100/100);
			$count = $count*100;

			$result = $count;
		//}

		return $result;
	}
}