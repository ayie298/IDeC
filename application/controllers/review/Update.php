<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/researcher/researcher_model');
		$this->load->model('idec_model');
	}

	public function index($id = null)
	{
		if($_POST) {
			
			$po   = $this->employee_model->find(array('nik' => $this->input->post('po')));
			$pm   = $this->employee_model->find(array('nik' => $this->input->post('pm')));
			$auto = $this->program_model->getAutoIncrement();

			$validation = array(
				array(
					'field' => 'budget',
					'label' => 'Budget',
					'rules' => 'numeric|required'
				)
			);

			$data = array(
				'name'		 				=> $this->input->post('name'),
				'description'				=> $this->input->post('desc'),
				'output'					=> $this->input->post('output'),
				'user'						=> $this->input->post('user'),
				'start_date'				=> $this->input->post('tanggal'),
				'end_date'					=> $this->input->post('tanggal_end'),
				'quartal'					=> $this->input->post('quartal'),
				'primary_program'			=> $this->input->post('prime'),
				'deliverable'				=> $this->input->post('deliver'),
				'KPI'						=> $this->input->post('kpi'),
				'implementation_strategy'	=> $this->input->post('implement'),
				'strategic_initative'		=> $this->input->post('strategic'),
				'id_organization_item'		=> $this->input->post('lab') == "" ? $this->input->post('unit') : $this->input->post('lab'),
				'id_employee_po'			=> $po->id_employee,
				'id_employee_pm'			=> $pm->id_employee,
				'id_annual_data'			=> 0,
				'show_on_review'			=> 0,
				'id_mas_project_status'		=> $this->input->post('status'),
				'id_mas_research_type'		=> $this->input->post('type'),
				'budget'					=> $this->input->post('budget')
			);
			
			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
				if(!empty($id) && $id !== 'index') {
					$this->db->where('id_program', $this->input->post('id'));
					$this->db->update('program', $data);

					$msg 	= 'updated';
					$idRed	= $this->input->post('id');

				} else {
					$data['id_program'] = $auto;

					$this->db->insert('program', $data);

					$msg 	= 'added';
					$idRed	= $auto;
				}

				$this->session->set_flashdata('notice', 'Program has been ' . $msg);

				redirect('program/update/' . md5($idRed));

			} else {
				$this->session->set_flashdata('notice', validation_errors());

				redirect('program/update/');
			}
		}

		$data['program']		= array();

		if(!empty($id) && $id !== 'index') {
			$program	= $this->program_model->find(array('md5(id_program)' => $id));
			$labs		= $this->employee_model->organization(array('id_organization_item' => $program->id_organization_item, 'level' => 'lab'), 'row');
			$po   		= $this->employee_model->find(array('id_employee' => $program->id_employee_po));
			$pm   		= $this->employee_model->find(array('id_employee' => $program->id_employee_pm));
			$tw 		= array();

			$data['program'] = $program;
			$data['labs']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item_parent' => $labs->id_organization_item_parent, 'level' => 'lab')) : '';
			$data['unit']	 = !empty($labs) ? $labs->id_organization_item_parent : $program->id_organization_item;
			$data['pm']		 = !empty($program->id_employee_pm) ? $pm->nik : NULL;
			$data['po']		 = !empty($program->id_employee_po) ? $po->nik : NULL;

			for($i=1;$i<=4;$i++) {
				$data['quartal']  = $i;

				$tw[] = $this->load->view(MODULE_VIEW_PATH.'program/program_tw', $data, TRUE);
			}

			$data['tw'] = $tw;
		}

		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));
		$data['status']			= $this->idec_model->findMaster('mas_project_status');
		$data['resType']		= $this->idec_model->findMaster('mas_research_type');
		$data['title']			= !empty($id) && $id !== 'index' ? 'Edit' : 'Add';

		$this->template->write_view('content', MODULE_VIEW_PATH.'program/program_new', $data);
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

				$data = array(
					'id_target_item' => $id,
					'target'		 => $this->input->post('value'),
					'target_detail'	 => $this->input->post('detail'),
					'id_mas_metric'	 => $this->input->post('metric'),
					'id_target'		 => $idTarget
				);

				$insert = $this->db->insert('target_item', $data);

				if($insert) {
					$dataProgram = array(
						'id_program' => $this->input->post('id_program'),
						'id_target'	 => $idTarget
					);

					$insert = $this->db->insert('program_target', $dataProgram);

					$this->session->set_flashdata('notice', 'Target TW ' . $this->input->post('quartal') . ' has been added');
				}
			} else {
				$this->session->set_flashdata('notice', validation_errors());
			}

			redirect('program/update/' . md5($this->input->post('id_program')));
		}

		show_404();
	}

	public function get_lab()
	{
		if($this->input->is_ajax_request()) {
			$idUnit = $this->input->post('unit');
			$labs 	= $this->employee_model->organization(array('id_organization_item_parent' => $idUnit));

			foreach($labs as $lab) :
				echo '<option value="'.$lab->id_organization_item.'">' . $lab->org_name . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}

	public function _remap($id, $params = "")
	{
		if(method_exists($this, $id)) {
			return $this->{$id}($params);
		} else {
			$this->index($id);
		}
	}
}