<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('idec_model');

		$this->template->set_template('login');
	}

	public function add($id = '')
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'degree',
					'label' => 'Degree',
					'rules' => 'required'
				),
				array(
					'field' => 'institute',
					'label' => 'Institute',
					'rules' => 'required'
				),
				array(
					'field' => 'start_year',
					'label' => 'Start Year',
					'rules' => 'required'
				),
				array(
					'field' => 'end_year',
					'label' => 'End Year',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {
				$data['education_degree'] 	= $this->input->post('degree');
				$data['institute']			= $this->input->post('institute');
				$data['major']				= $this->input->post('major');
				$data['start_year']			= $this->input->post('start_year');
				$data['end_year']			= $this->input->post('end_year');
				$data['id_employee']		= $this->input->post('id');

				if($this->input->post('id_edu') == "") {
					$this->db->insert('employee_education', $data);
				} else {
					$this->db->where('id_employee_education', $this->input->post('id_edu'));
					$this->db->update('employee_education', $data);
				}

				$datas['notice'] = 'Data berhasil disimpan';
				$datas['error']	= 0;
			} else {
				$datas['notice'] = validation_errors();
				$datas['error']	= 1;
			}

			//redirect('idec/employee/edit/' . md5($this->input->post('id')));
			echo json_encode($datas);

			return FALSE;
		}

		$id_mas = $this->input->get('id_edu') == "" ? "" : $this->input->get('id_edu');

		$data['education_emp']	= array();

		if(!empty($id_mas)) {
			$data['education_emp'] 	= $this->employee_model->education(array('id_employee_education' => $id_mas), 'row');
		}

		$data['title'] 			= $this->input->get('id_edu') == "" ? 'Add' : 'edit';
		$data['id_employee'] 	= $id;

		$this->load->view(MODULE_VIEW_PATH.'employee/employee_education_add', $data);
	}

	public function delete()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_employee_education', $id);
			$this->db->delete('employee_education');
		}
	}
}
