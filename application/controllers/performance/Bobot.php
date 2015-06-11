<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bobot extends CI_Controller {

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

	public function update($id = null)
	{
		if($_POST) {
			$id  = $this->input->post('id');

			if(!empty($id)) {
				for($i=0;$i<sizeof($id);$i++) {
					$this->db->where('id_performance_system_item', $id[$i]);
					$this->db->delete('performance_quartal');

					$tw = $this->input->post('tw'.$id[$i]);

					for($j=0;$j<sizeof($tw);$j++) {
						$data = array(
							'id_performance_quartal'		=> $this->program_model->getAutoIncrement('performance_quartal', 'id_performance_quartal'),
							'period' 						=> $j+1,
							'weight' 						=> $tw[$j],
							'id_performance_system_item'	=> $id[$i]
						);

						$this->db->insert('performance_quartal', $data);
					}
				}

				$this->session->set_flashdata('notice', 'Weight has been updated');

				redirect(current_url());
			}
		}

		$data['performance'] = $this->performance_model->find('getPerformance', array('md5(id_performance_system)' => $id));

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_indicator_bobot', $data);
		$this->template->render();
	}

	public function json($id = 0)
	{
		$program = $this->performance_model->findAll('getPerspective');

		foreach($program as $prog) {
			$pers = $this->items($id, $prog->id_mas_perspective);

			$data[] = array(
				'id'   			=> (int) $prog->id_mas_perspective,
				'perspective'   => $prog->perspective,
				'level'			=> 1,
				'tw1'		=> '',
				'tw2'		=> '',
				'tw3' 		=> '',
				'tw4'		=> '',
				'total'		=> $pers['total']/4
			);

			$dataPers = $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => $id, 'id_mas_perspective' => $prog->id_mas_perspective));

			foreach($dataPers as $pers) {
				$tw1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 1));
				$tw2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 2));
				$tw3 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 3));
				$tw4 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 4));
				
				$tw1 = empty($tw1) ? 0 : $tw1->weight;
				$tw2 = empty($tw2) ? 0 : $tw2->weight;
				$tw3 = empty($tw3) ? 0 : $tw3->weight;
				$tw4 = empty($tw4) ? 0 : $tw4->weight;

				$data[] = array(
					'id'   			=> (int) $pers->id_performance_system_item,
					'perspective'   => '<input type="hidden" name="id[]" value="'.$pers->id_performance_system_item.'" />'.$pers->name,
					'level'			=> 2,
					'tw1'			=> '<input type="text" name="tw'.$pers->id_performance_system_item.'[]" value="'.$tw1.'" />',
					'tw2'			=> '<input type="text" name="tw'.$pers->id_performance_system_item.'[]" value="'.$tw2.'" />',
					'tw3' 			=> '<input type="text" name="tw'.$pers->id_performance_system_item.'[]" value="'.$tw3.'" />',
					'tw4'			=> '<input type="text" name="tw'.$pers->id_performance_system_item.'[]" value="'.$tw4.'" />',
					'total'			=> 0
				);
			}
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	private function items($id, $id_pers)
	{
		$dataPers = $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => $id, 'id_mas_perspective' => $id_pers));
		$totalPers= 0;
		$perform  = array();

			foreach($dataPers as $pers) {
				$tw1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 1));
				$tw2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 2));
				$tw3 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 3));
				$tw4 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => 4));
				
				$tw1 = empty($tw1) ? 0 : $tw1->weight;
				$tw2 = empty($tw2) ? 0 : $tw2->weight;
				$tw3 = empty($tw3) ? 0 : $tw3->weight;
				$tw4 = empty($tw4) ? 0 : $tw4->weight;

				$perform[] = array(
					'id'   			=> (int) $pers->id_performance_system_item,
					'perspective'   => $pers->name,
					'level'			=> 2,
					'tw1'			=> $tw1,
					'tw2'			=> $tw2,
					'tw3' 			=> $tw3,
					'tw4'			=> $tw4,
				);

				$totalPers += $tw1+$tw2+$tw3+$tw4;
			}

		return array('datas' => $perform, 'total' => $totalPers);
	}
}