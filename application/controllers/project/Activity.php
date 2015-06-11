<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

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

	public function add()
	{
		if($this->input->post('btn_simpan')) {
			$validation = array(
				array(
					'field' => 'step',
					'Lable' => 'Step',
					'rules' => 'required'
				),
				array(
					'field' => 'name',
					'Lable' => 'Activity Name',
					'rules' => 'required'
				),
				array(
					'field' => 'location',
					'Lable' => 'Location',
					'rules' => 'required'
				),
				array(
					'field' => 'desc',
					'Lable' => 'Description',
					'rules' => 'required'
				),
				array(
					'field' => 'step',
					'Lable' => 'Step',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {
				$member = $this->project_model->memberProject($this->user->row()->id_employee, 'row', array('employee_project.id_project' => $this->input->post('id')));
				
				$data['activity_start_date'] 	= $this->input->post('start_date');
				$data['activity_end_date'] 		= $this->input->post('end_date');
				$data['activity_name']			= $this->input->post('name');
				$data['activity_detail']		= $this->input->post('desc');
				$data['location']				= $this->input->post('location');
				$data['id_employee_project']	= $member->id_employee_project;
				$data['id_project_step']		= $this->input->post('step');
				$data['id_mas_project_status'] 	= $this->input->post('status');

				if(empty($member)) {
					$this->session->set_flashdata('notice', 'Anda tidak memiliki akses untuk menambahkan activity');
					
					redirect('researcher/project/detail/' . md5($this->input->post('id')));
				}

				if($this->input->post('id_act') == "") {
					$insert = $this->db->insert('employee_activity_log', $data);	
					$msg	= 'added';
				} else {
					$this->db->where('id_employee_activity_log', $this->input->post('id_act'));
					
					$insert = $this->db->update('employee_activity_log', $data);
					$msg	= 'updated';
				}
				
				$this->session->set_flashdata('notice', 'Activity has been ' . $msg);
			} else {
				$this->session->set_flashdata('notice', validation_errors());
			}

			redirect('researcher/project/detail/' . md5($this->input->post('id')));

			return FALSE;
		}

		$data['activity']		= array();

		if($this->input->post('id_act') != '') {
			$data['activity'] 	= $this->project_model->activityLog($this->input->post('id_project'), array('employee_activity_log.id_employee_activity_log', $this->input->post('id_act')), 'row');
		}

		$data['project']		= $this->project_model->find(array('id_project' => $this->input->post('id_project')));
		$data['id_project']		= $this->input->post('id_project');
		$data['project_step']	= $this->project_model->findStepAll(array('id_project' => $this->input->post('id_project')));
		$data['status']			= $this->idec_model->findMaster('mas_project_status');

		$this->load->view(MODULE_VIEW_PATH.'project/project_add_activity', $data);
	}

	public function delete()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_employee_activity_log', $id);
			$this->db->delete('employee_activity_log');
		}
	}

	public function activity_json($id = 0)
	{
		$data	  	= array();
		$filter 	= array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$activity = $this->project_model->activityLog($id);

		foreach($activity as $act) {
			$data[] = array(
				'id'   				=> (int) $act->id_employee_activity_log,
				'id_encrypt'   		=> md5($act->id_employee_activity_log),
				'step_name'			=> $act->step_name,
				'emp.name'			=> $act->name,
				'nik'				=> $act->nik,
				'activity_detail'	=> $act->activity_detail,
				'location'			=> $act->location,
				'status'			=> $act->status,
				'activity_start_date'=> $act->activity_start_date,
				'activity_end_date'	=> $act->activity_end_date,
				'is_lock'			=> $act->id_employee == $this->user->row()->id_employee ? FALSE : TRUE
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
