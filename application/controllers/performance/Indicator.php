<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator extends CI_Controller {

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

	public function detail($id = 0) 
	{
		$tw = array();

		$data['indicator'] 				= $this->performance_model->find('getItem', array('performance_system_item.id_performance_system_item' => $id));
		$data['perspective'] 			= $this->performance_model->findAll('getPerspective');
		$data['unit'] 					= $this->employee_model->organization(array('level' => 'subunit'));
		$data['program'] 				= $this->program_model->findAll();
		$data['strategic'] 				= $this->idec_model->findMaster('mas_strategic_objective');
		$data['formula_achievement'] 	= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "achievement"'));
		$data['formula_realisasi'] 		= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "realization"'));
		$data['formula1']			 	= $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $data['indicator']->id_performance_indicator));
		$data['formula2'] 				= $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $data['indicator']->id_performance_indicator));

		for($i=1;$i<=4;$i++) {
			$target = $this->performance_model->find('getTarget', array('id_performance_system_item' => $id, 'period' => $i));

			$data['quartal']  = $i;
			$data['id']		  = $id;
			$data['id_target']= !empty($target) ? $target->id_target : '';
			$data['target']	  = $target;

			$tw[] = $this->load->view(MODULE_VIEW_PATH.'performance/performance_indicator_tw_detail', $data, TRUE);
		}

		$data['tw'] = $tw;

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_indicator_detil', $data);
		$this->template->render();
	}

	public function update($id = null)
	{
		$data['performance'] = $this->performance_model->find('getPerformance', array('id_performance_system' => $id));

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_indicator', $data);
		$this->template->render();
	}

	public function add($id = 0, $id_pers = 0, $id_parent = 0)
	{
		if($_POST) {
			if($this->input->post('save_new')) {
				$idPerformance = $this->program_model->getAutoIncrement('performance_indicator', 'id_performance_indicator');

				$data = array(
					'id_performance_indicator' 	=> $idPerformance,
					'name'						=> $this->input->post('name'),
					'description'				=> $this->input->post('desc'),
					'measure_definition'		=> $this->input->post('definition'),
					'evidence'					=> $this->input->post('evidence'),
					'id_program'				=> $this->input->post('program'),
					'id_mas_strategic_objective'=> $this->input->post('objective'),
					'is_default'				=> 0,
					'indicator_type'			=> $this->input->post('kpi')
				);

				$insert = $this->db->insert('performance_indicator', $data);

				$dataForReal = array(
					'id_performance_indicator'  		=> $idPerformance,
					'id_mas_formula'					=> $this->input->post('for_realisasi'),
					'id_formula_performance_indicator'	=> $this->program_model->getAutoIncrement('formula_performance_indicator', 'id_formula_performance_indicator')
				);

				$insert = $this->db->insert('formula_performance_indicator', $dataForReal);

				$dataForReal = array(
					'id_performance_indicator'  		=> $idPerformance,
					'id_mas_formula'					=> $this->input->post('for_achieve'),
					'id_formula_performance_indicator'	=> $this->program_model->getAutoIncrement('formula_performance_indicator', 'id_formula_performance_indicator')
				);

				$insert = $this->db->insert('formula_performance_indicator', $dataForReal);

				$data = array(
					'id_performance_system_item'		=> $this->program_model->getAutoIncrement('performance_system_item', 'id_performance_system_item'),
					'id_performance_indicator' 			=> $idPerformance,
					'id_performance_system'				=> $id,
					'id_performance_system_item_parent'	=> $id_parent == 0 ? 0 : $id_parent,
					'id_mas_perspective'				=> $this->input->post('pers'),
				);

				$insert = $this->db->insert('performance_system_item', $data);

				$this->session->set_flashdata('notice', 'Indicator has been added');
			}

			if($this->input->post('submit_exist')) {
				$idPerformance = $this->program_model->getAutoIncrement('performance_indicator', 'id_performance_indicator');
				$existing = array();

				$existing = $this->db->where('id_performance_indicator', $this->input->post('existing'))->get('performance_indicator')->row();

				$data = array(
					'id_performance_indicator' 	=> $idPerformance,
					'name'						=> $existing->name,
					'description'				=> $existing->description,
					'measure_definition'		=> $existing->measure_definition,
					'evidence'					=> $existing->evidence,
					'id_program'				=> $existing->id_program,
					'id_mas_strategic_objective'=> $existing->id_mas_strategic_objective,
					'is_default'				=> 0,
					'indicator_type'			=> $existing->indicator_type
				);

				$insert = $this->db->insert('performance_indicator', $data);

				$indicator = $this->db->where('id_performance_indicator', $existing->id_performance_indicator)->get('formula_performance_indicator')->result();

				foreach($indicator as $ind) :
				$dataForReal = array(
					'id_performance_indicator'  		=> $idPerformance,
					'id_mas_formula'					=> $ind->id_mas_formula,
					'id_formula_performance_indicator'	=> $this->program_model->getAutoIncrement('formula_performance_indicator', 'id_formula_performance_indicator')
				);

				$insert = $this->db->insert('formula_performance_indicator', $dataForReal);
				endforeach;

				$data = array(
					'id_performance_system_item'		=> $this->program_model->getAutoIncrement('performance_system_item', 'id_performance_system_item'),
					'id_performance_indicator' 			=> $idPerformance,
					'id_performance_system'				=> $id,
					'id_performance_system_item_parent'	=> $id_parent == 0 ? 0 : $id_parent,
					'id_mas_perspective'				=> $id_pers,
				);

				$insert = $this->db->insert('performance_system_item', $data);

				$this->session->set_flashdata('notice', 'Indicator has been added');
			}


			redirect(current_url());

			return FALSE;
		}

		$data['existing'] 				= $this->performance_model->findAll('getIndicator');
		$data['perspective'] 			= $this->performance_model->findAll('getPerspective');
		$data['unit'] 					= $this->employee_model->organization(array('level' => 'subunit'));
		$data['program'] 				= $this->program_model->findAll();
		$data['strategic'] 				= $this->idec_model->findMaster('mas_strategic_objective');
		$data['formula_achievement'] 	= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "achievement"'));
		$data['formula_realisasi'] 		= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "realization"'));
		$data['id']						= $id;

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_indicator_add', $data);
		$this->template->render();
	}

	public function edit($id = NULL)
	{
		if($_POST) {
			$data = array(
					'name'						=> $this->input->post('name'),
					'description'				=> $this->input->post('desc'),
					'measure_definition'		=> $this->input->post('definition'),
					'evidence'					=> $this->input->post('evidence'),
					'id_program'				=> $this->input->post('program'),
					'id_mas_strategic_objective'=> $this->input->post('objective'),
					'is_default'				=> 0,
					'indicator_type'			=> $this->input->post('kpi')
			);

			$this->db->where('id_performance_indicator', $this->input->post('id_indicator'));

			$insert = $this->db->update('performance_indicator', $data);

			if($insert) {
				$dataForReal = array(
					'id_mas_formula'	=> $this->input->post('for_realisasi'),
				);

				$this->db->where('id_formula_performance_indicator', $this->input->post('idForReal'));
				$this->db->update('formula_performance_indicator', $dataForReal);

				$dataForReal = array(
					'id_mas_formula' => $this->input->post('for_achieve'),
				);

				$this->db->where('id_formula_performance_indicator', $this->input->post('idForAchieve'));
				$this->db->update('formula_performance_indicator', $dataForReal);
			}

			$this->session->set_flashdata('notice', 'Indicator has been updated');

			redirect(current_url());

			return FALSE;
		}

		$tw = array();

		$data['indicator'] 				= $this->performance_model->find('getItem', array('performance_system_item.id_performance_system_item' => $id));
		$data['perspective'] 			= $this->performance_model->findAll('getPerspective');
		$data['unit'] 					= $this->employee_model->organization(array('level' => 'subunit'));
		$data['program'] 				= $this->program_model->findAll();
		$data['strategic'] 				= $this->idec_model->findMaster('mas_strategic_objective');
		$data['formula_achievement'] 	= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "achievement"'));
		$data['formula_realisasi'] 		= $this->idec_model->findMaster('mas_formula', array('where' => 'type = "realization"'));
		$data['formula1']			 	= $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $data['indicator']->id_performance_indicator));
		$data['formula2'] 				= $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $data['indicator']->id_performance_indicator));

		for($i=1;$i<=4;$i++) {
			$target = $this->performance_model->find('getTarget', array('id_performance_system_item' => $id, 'period' => $i));

			$data['quartal']  = $i;
			$data['id']		  = $id;
			$data['id_target']= !empty($target) ? $target->id_target : 0;
			$data['targets']  = !empty($target) ? $this->performance_model->findAll('getAllTarget', array('target_item.id_target' => $target->id_target)) : array();

			$tw[] = $this->load->view(MODULE_VIEW_PATH.'performance/performance_indicator_tw_detail', $data, TRUE);
		}

		$data['tw'] = $tw;

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_indicator_edit', $data);
		$this->template->render();
	}

	public function target()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'value',
					'label' => 'Value',
					'rules' => 'required'
				),
				array(
					'field' => 'detail',
					'label' => 'Detail',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {

				if($this->input->post('id_target') == 0) {
				
				$id 		= $this->program_model->getAutoIncrement('target_item', 'id_target_item');
				$idTarget 	= $this->program_model->getAutoIncrement('target', 'id_target');

				switch ($this->input->post('quartal')) {
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

				$dataTarget = array(
					'id_target' => $idTarget,
					'period'	=> $period
				);

				$insert = $this->db->insert('target', $dataTarget);
				}

				$data = array(
					'target'		 => $this->input->post('value'),
					'target_detail'	 => $this->input->post('detail'),
					'id_mas_metric'	 => $this->input->post('metric'),
				);

				$data['id_target_item']	= $this->program_model->getAutoIncrement('target_item', 'id_target_item');
				$data['id_target'] 		= $this->input->post('id_target') == 0 ? $idTarget : $this->input->post('id_target');
					
				$insert = $this->db->insert('target_item', $data);

				if($insert && $this->input->post('id_target') == 0) {
					$dataProgram = array(
						'id_target'	 => $idTarget
					);

					$this->db->where(array('id_performance_system_item' => $this->input->post('id'), 'period' => $this->input->post('quartal')));
					
					$insert = $this->input->post('id_target') == 0 ? $this->db->update('performance_quartal', $dataProgram) : FALSE;

					$this->session->set_flashdata('notice', 'Target TW ' . $this->input->post('quartal') . ' has been added');
				}

			} else {
				$this->session->set_flashdata('notice', validation_errors());
			}

			redirect('performance/indicator/edit/' . $this->input->post('id'));
		}

		show_404();
	}

	public function edit_target()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'value',
					'label' => 'Value',
					'rules' => 'required'
				),
				array(
					'field' => 'detail',
					'label' => 'Detail',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
				$data = array(
					'target'		 => $this->input->post('value'),
					'target_detail'	 => $this->input->post('detail'),
					'id_mas_metric'	 => $this->input->post('metric'),
				);

				$this->db->where('id_target_item', $this->input->post('id_item_target'));
				$this->db->update('target_item', $data);

				$this->session->set_flashdata('notice', 'Target berhasil disimpan');
			} else {
				$this->session->set_flashdata('notice', validation_errors());
			}

			redirect('performance/indicator/edit/' . $this->input->post('id'));
		}

		show_404();
	}

	public function delete_target($id = 0, $id_pers)
	{
		$this->db->where('md5(id_target_item)', $id);
		$this->db->delete('target_item');

		$this->session->set_flashdata('notice', 'Target berhasil dihapus');

		redirect('performance/indicator/edit/' . $id_pers);

		show_404();
	}

	public function add_target()
	{
		if($_POST && $this->input->is_ajax_request()) {
			$data['id_target'] 	= $this->input->post('id');
			$data['id']			= $this->input->post('id_per');
			$data['quartal']	= $this->input->post('quartal');
			$data['metric']		= $this->idec_model->findMaster('mas_metric');
			$data['target']		= array();

			if($this->input->post('id_target_item') != '') {
				$data['target'] = $this->performance_model->find('getAllTarget', array('id_target_item' => $this->input->post('id_target_item')));
			}

			$this->load->view(MODULE_VIEW_PATH.'performance/performance_indicator_tw', $data);

			return FALSE;
		} 

		show_404();
	}

	public function analysis($id = '')
	{
		if($_POST) {
			$data = array(
				'analysis' => $this->input->post('analysis'),
				'recommendation' => $this->input->post('rec'),
				'evaluation' => $this->input->post('evaluasi')
			);

			$this->db->where('id_performance_quartal', $id);
			$this->db->update('performance_quartal', $data);

			$get = $this->db->where('id_performance_quartal', $id)->get('performance_quartal')->row();

			redirect('performance/target/edit/' . $get->id_performance_system_item);
		}

		if($this->input->is_ajax_request()) {
			$data['data'] = $get = $this->db->where('id_performance_quartal', $id)->get('performance_quartal')->row();
			$data['id']   = $id;

			$this->load->view(MODULE_VIEW_PATH.'performance/performance_target_analysis', $data);
		}
	}

	public function budget($id = '')
	{
		if($_POST) {
			$data = array(
				'budget_realization' => $this->input->post('budget'),
			);

			$this->db->where('id_performance_quartal', $id);
			$this->db->update('performance_quartal', $data);

			$get = $this->db->where('id_performance_quartal', $id)->get('performance_quartal')->row();

			redirect('performance/target/edit/' . $get->id_performance_system_item);
		}

		if($this->input->is_ajax_request()) {
			$data['data'] = $get = $this->db->where('id_performance_quartal', $id)->get('performance_quartal')->row();
			$data['id']   = $id;

			$this->load->view(MODULE_VIEW_PATH.'performance/performance_budget', $data);
		}
	}

	public function json($id = 0)
	{
		$program = $this->performance_model->findAll('getPerspective');

		foreach($program as $prog) {
			$pers = $this->items($id, $prog->id_mas_perspective);

			$data[] = array(
				'id'   			=> (int) $prog->id_mas_perspective,
				'id_pers'   	=> $prog->id_mas_perspective,
				'perspective'   => $prog->perspective,
				'level'			=> 1,
				'tw1'			=> '',
				'tw2'			=> '',
				'tw3' 			=> '',
				'tw4'			=> '',
				'total'			=> $pers['total']/4
			);

			$dataPers = $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => $id, 'id_mas_perspective' => $prog->id_mas_perspective, 'id_performance_system_item_parent' => 0));

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
					'id_pers'   	=> $prog->id_mas_perspective,
					'perspective'   => $pers->name,
					'level'			=> 2,
					'tw1'			=> $tw1,
					'tw2'			=> $tw2,
					'tw3' 			=> $tw3,
					'tw4'			=> $tw4,
				);

				$dataPers2 = $this->performance_model->findAll('getItem', array('performance_system_item.id_performance_system_item_parent' => $pers->id_performance_system_item));

			foreach($dataPers2 as $pers2) {
				$tw1_2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers2->id_performance_system_item, 'period' => 1));
				$tw2_2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers2->id_performance_system_item, 'period' => 2));
				$tw3_2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers2->id_performance_system_item, 'period' => 3));
				$tw4_2 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers2->id_performance_system_item, 'period' => 4));
				
				$tw1_2 = empty($tw1_2) ? 0 : $tw1_2->weight;
				$tw2_2 = empty($tw2_2) ? 0 : $tw2_2->weight;
				$tw3_2 = empty($tw3_2) ? 0 : $tw3_2->weight;
				$tw4_2 = empty($tw4_2) ? 0 : $tw4_2->weight;

				$data[] = array(
					'id'   			=> (int) $pers2->id_performance_system_item,
					'perspective'   => $pers2->name,
					'level'			=> 3,
					'tw1'			=> $tw1_2,
					'tw2'			=> $tw2_2,
					'tw3' 			=> $tw3_2,
					'tw4'			=> $tw4_2,
				);
			}
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