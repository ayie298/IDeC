<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		$this->template->write_view('content', MODULE_VIEW_PATH.'project/project');
		$this->template->render();
	}

	public function update($id = "")
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				), 
				array(
					'field' => 'unit',
					'label' => 'Unit',
					'rules' => 'required'
				),
				array(
					'field' => 'program',
					'label' => 'Program',
					'rules' => 'required'
				),
				array(
					'field' => 'tanggal',
					'label' => 'Start Date',
					'rules' => 'required'
				),
				array(
					'field' => 'tanggal_end',
					'label' => 'End Date',
					'rules' => 'required'
				),
				array(
					'field' => 'status',
					'label' => 'Status',
					'rules' => 'required'
				),
				array(
					'field' => 'weight',
					'label' => 'Weight',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
				$times = $this->input->post('stream');
				$auto  = $this->project_model->getAutoIncrement();
				$data = array(
					'name'					=> $this->input->post('name'),
					'project_description'	=> $this->input->post('desc'),
					'weight'				=> $this->input->post('weight'),
					'start_date'			=> $this->input->post('tanggal'),
					'end_date'				=> $this->input->post('tanggal_end'),
					'percent_progress'		=> 0,
					'last_progress_update'	=> date('Y-m-d H:i:s'),
					'id_program'			=> $this->input->post('program'),
					'id_organization_item'	=> $this->input->post('unit'),
					'id_annual_data'		=> '',
					'id_mas_project_status'	=> $this->input->post('status'),
					'id_mas_times_category'	=> serialize($times)
				);

				if(!empty($id)) {
					$this->db->where('id_project', $this->input->post('id'));

					$insert = $this->db->update('project', $data);
				} else {
					$data['id_project'] = $auto;

					$insert = $this->db->insert('project', $data);
				}

				if($insert) {
					$this->session->set_flashdata('notice', 'Data berhasil disimpan');

					if(!empty($id)) {
						redirect('researcher/project/update/' . $id);
					} else {
						redirect('researcher/project/update/' . md5($auto));
					}
				}
			} else {
				$data['notice'] = validation_errors();
			}
		}

		$data['project']		= array();

		if(!empty($id)) {
			$data['project']	= $this->project_model->find(array('md5(id_project)' => $id));
		}

		$data['id_project']		= empty($id) ? "" : $data['project']->id_project;
		$data['program'] 		= $this->program_model->findAll();
		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));
		$data['status']			= $this->idec_model->findMaster('mas_project_status');
		$data['competence']		= $this->idec_model->findMaster('mas_times_category');
		$data['project_step']	= $this->load->view(MODULE_VIEW_PATH.'project/project_step', $data, TRUE);
		$data['project_member']	= $this->load->view(MODULE_VIEW_PATH.'project/project_member', $data, TRUE);

		$this->template->write_view('content', MODULE_VIEW_PATH.'project/project_add', $data);
		$this->template->render();
	}

	public function detail($id = 0)
	{
		$data['project']		= $this->project_model->find(array('md5(id_project)' => $id));
		$data['id_project']		= $data['project']->id_project;
		$data['detail']			= TRUE;
		$data['detail_view']	= TRUE;
		$data['is_team']		= (bool) $this->db->where(array('id_employee' => $this->user->row()->id_employee, 'id_project' => $data['id_project']))->get('employee_project')->num_rows();
		$data['step']			= $this->load->view(MODULE_VIEW_PATH.'project/project_step', $data, TRUE);
		$data['member']			= $this->load->view(MODULE_VIEW_PATH.'project/project_member', $data, TRUE);
		$data['activity']		= $this->load->view(MODULE_VIEW_PATH.'project/project_activity', $data, TRUE);

		$this->template->write_view('content', MODULE_VIEW_PATH.'project/project_detail', $data);
		$this->template->render();
	}

	public function add_step($id = "")
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				), 
				array(
					'field' => 'tanggal',
					'label' => 'Start Date',
					'rules' => 'required'
				),
				array(
					'field' => 'tanggal_end',
					'label' => 'End Date',
					'rules' => 'required'
				),
				array(
					'field' => 'bobot',
					'label' => 'Bobot',
					'rules' => 'required|numeric'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
				$data = array(
					'step_name' 		=> $this->input->post('name'),
					'step_description'	=> $this->input->post('desc'),
					'start_date'		=> $this->input->post('tanggal'),
					'end_date'			=> $this->input->post('tanggal_end'),
					'weight'			=> $this->input->post('bobot'),
					'id_project'		=> $this->input->post('id')
				);

				if(!empty($id)) {
					$this->db->where('id_project_step', $id);

					$insert = $this->db->update('project_step', $data);
				} else {
					$insert = $this->db->insert('project_step', $data);
				}

				if($insert) {
					$datas['notice'] = 'Data berhasil disimpan';
					$datas['error']	= 0;
				}
			} else {
				$datas['notice'] = validation_errors();
				$datas['error']	= 1;
			}

			//redirect('researcher/project/update/' . md5($this->input->post('id')));

			echo json_encode($datas);
			
			return FALSE;
		}

		$data['step']	= array();
		$data['id'] 	= $this->input->get('id');

		if(!empty($id)) {
			$data['step'] = $this->project_model->findStep(array('id_project_step' => $id));
		}

		$this->load->view(MODULE_VIEW_PATH.'project/project_add_step', $data);
	}

	public function step_json($id = "")
	{
		$data 		 = array();
		$filter 	 = array();
		$filterLike  = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$filterLike[$field] = $value;
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$steps = $this->project_model->findStepAll(array('project_step.id_project' => $id), array(), $filterLike);

		foreach($steps as $step) {
			$data[] = array(
				'id'   		 	=> $step->id_project_step,
				'id_project' 	=> $step->id_project,
				'id_encrypt'   	=> md5($step->id_project_step),
				'step_name' 	=> $step->step_name,
				'weight'   	 	=> $step->weight,
				'start_date'  	=> $step->start_date,
				'end_date' 	 	=> $step->end_date,
				'step_description'	=> $step->step_description
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function delete_step($id_project, $id = 0)
	{
		$this->db->where('md5(id_project_step)', $id);
		$this->db->delete('project_step');

		$this->session->set_flashdata('notice', 'Project step deleted');

		redirect('researcher/project/update/' . md5($id_project));
	}

	public function delete($id = 0)
	{
		$this->db->where('md5(id_project)', $id);
		$this->db->delete('employee_project');

		$this->db->where('md5(id_project)', $id);
		$this->db->delete('project_step');

		$this->db->where('md5(id_project)', $id);
		$this->db->delete('project');

		$this->session->set_flashdata('notice', 'Project deleted');

		redirect('researcher/project/');
	}

	public function member_json($id = "")
	{
		$data  		 = array();
		$filter 	 = array();
		$filterLike  = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$filterLike[$field] = $value;
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$steps = $this->project_model->findMemberAll(array('employee_project.id_project' => $id), array(), $filterLike);

		foreach($steps as $step) {
			$data[] = array(
				'id'   		=> $step->id_employee_project,
				'employee.name' => $step->name,
				'nik'		=> $step->nik,
				'title' 	=> $step->title,
				'position'	=> $step->position,
				'id_proj'	=> (int) $id,
				'id_emp'	=> $step->id_employee
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function project_json()
	{
		if($this->input->post('year')) {
			$this->session->set_userdata('searchYear', $this->input->post('year'));

			return FALSE;
		}

		$data  = array();
		$filter = array();
		$filterCount = array();
		$year  = $this->session->userdata('searchYear') == "" ? date('Y') : $this->session->userdata('searchYear');
		$filterLike = !empty($_POST) ? '' : array('start_date' => $year);

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'start_date') {
					$filter[$field.'>='] = $value;
				} elseif($field == 'end_date') {
					$filter[$field.'<='] = $value;
				} elseif($field == 'team') {
					$field = $field == 'team' ? '(SELECT COUNT(id_employee) FROM employee_project WHERE id_project = project.id_project) =' : $field;
					$filter[$field] = $value;
				} else {
					$filterLike[$field] = $value;
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$steps = $this->project_model->findProjectAll($filter, array(), $filterLike);

		foreach($steps as $step) {
			$data[] = array(
				'id'   		=> (int) $step->id_project,
				'id_encrypt'=> md5($step->id_project),
				'name'		=> $step->name,
				'org_name'	=> $step->org_name,
				'start_date'=> $step->start_date,
				'end_date'	=> $step->end_date,
				'status'	=> $step->status,
				'weight'	=> $step->weight,
				'team'		=> (int) $step->team
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('searchYear');
	}

	public function delete_team()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_employee_project', $id);
			$this->db->delete('employee_project');
		}
	}
}
