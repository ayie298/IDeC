<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {

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
		$this->load->model('modules/performance/performance_model');
		$this->load->model('idec_model');
	}

	public function update($ids = null)
	{
		$notice = "";

		if($_POST) {
			$id = $this->program_model->getAutoIncrement('performance_system', 'id_performance_system');

			$validation = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
			if(empty($ids)) {
				$data = array(
				'perform_name' 			=> $this->input->post('name'),
				'desc' 					=> $this->input->post('desc'),
				'date' 					=> date('Y-m-d'),
				'id_organization_item'	=> $this->input->post('employee') == '' ? $this->input->post('unit')  : NULL,
				'id_employee'			=> $this->input->post('employee'),
				'limit_max'				=> 150,
				'limit_min'				=> 60,
				);

				$data['id_performance_system'] = $id;

				$this->db->insert('performance_system', $data);
			} else {
				$data['desc'] 			= $this->input->post('desc');
				$data['perform_name'] 	= $this->input->post('name');

				$this->db->where('id_performance_system', $ids[0]);
				$this->db->update('performance_system', $data);
			}

			$this->session->set_flashdata('notice', 'Data berhasil disimpan');

			redirect('performance');

			} else {
				$notice = validation_errors();
			}
		}

		$data['performance'] = array();

		if(!empty($ids)) {
			$data['performance'] = $this->performance_model->find('getPerformance', array('id_performance_system' => $ids[0]));
		}

		$data['notice']			= !empty($notice) ? $notice : '';
		$data['title']			= !empty($ids) ? 'Edit' : 'Add';
		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_new', $data);
		$this->template->render();
	}

	public function evidence()
	{
		if($_POST)
		{
			$upload = $this->files->uploads('userfile','pdf', '', FALSE);

			if(!empty($upload['error'])) {
				$this->session->set_flashdata('notice', $upload['message']);
			} else {
				$data = array(
						'description' 			=> $this->input->post('desc'),
						'file'		  			=> $upload['filename'],
						'id_performance_system'	=> $this->input->post('id')
					);

				$this->db->insert('performance_evidence', $data);

				$this->session->set_flashdata('notice', 'File berhasil disimpan');
			}

			redirect('performance/detail/' . md5($this->input->post('id')));
		}

		if($this->input->is_ajax_request()) {
			$data['id'] = $this->input->get('id');

			$this->load->view(MODULE_VIEW_PATH.'performance/performance_evidence', $data);
		}
	}

	public function delete()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_performance_system', $id);
			$this->db->delete('performance_system');
		}
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