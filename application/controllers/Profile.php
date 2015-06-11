<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'nik',
					'label' => 'NIK',
					'rules' => 'required'
				),
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required'
				),
				array(
					'field' => 'bp',
					'label' => 'BP',
					'rules' => 'required'
				),
				array(
					'field' => 'unit',
					'label' => 'Unit',
					'rules' => 'required'
				),
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {

			$data['nik']  				  	  = $this->input->post('nik');
			$data['name'] 				  	  = $this->input->post('name');
			$data['gender']				  	  = $this->input->post('gender');
			$data['id_mas_bp'] 			  	  = $this->input->post('bp');
			$data['id_mas_title']			  = $this->input->post('title');
			$data['date_of_birth']			  = $this->input->post('date');
			$data['id_organization_item']	  = $this->input->post('lab') == "" ? $this->input->post('unit') : $this->input->post('lab');
			$data['id_mas_employee_position'] = $this->input->post('position');

			$upload = $this->files->uploads('userfile', 'pdf', 'cv/');
			$photo  = $this->files->uploads('userphoto', 'jpg|jpeg', 'photo/');

			if((!empty($photo['error'])) && !empty($_FILES['userphoto']['name'])) {
				$data['notice'] = $photo['message'];
			} elseif((!empty($upload['error']) || $upload['error'] == 1) && !empty($_FILES['userfile']['name'])) {
				$data['notice'] = $upload['message'];
			} else {

			$data['cv_document'] = !empty($_FILES['userfile']['name']) ? $upload['filename'] : '';
			$data['photo'] = !empty($_FILES['userphoto']['name']) ? $photo['filename'] : '';

			if(!empty($data['photo'])) {
				$this->session->set_userdata('photo', $photo['filename']);
			}

			$return = $this->employee_model->update($this->user->row()->id_employee, $data);

				$id = md5($this->user->row()->id_employee);

			if($return) {
				//$this->session->set_flashdata('notice', 'Data saved');

				//redirect('idec/employee/edit/' . $id);
				$data['notice'] = 'Data berhasil disimpan';
			}
			}

			} else {
				$data['notice'] = validation_errors();
			}
		}

		$employee	= $this->employee_model->find(array('md5(id_employee)' => md5($this->user->row()->id_employee)));
		$labs		= $this->employee_model->organization(array('id_organization_item' => $employee->id_organization_item, 'level' => 'lab'), 'row');

		$data['labs']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item_parent' => $labs->id_organization_item_parent, 'level' => 'lab')) : array();
		$data['unit']	 = !empty($labs) ? $labs->id_organization_item_parent : $employee->id_organization_item;
		$data['employee'] 	  = $this->employee_model->find(array('md5(id_employee)' => md5($this->user->row()->id_employee)));
		$data['bps'] 	  	  = $this->employee_model->getBP();
		$data['position'] 	  = $this->employee_model->position();
		$data['organization'] = $this->employee_model->organization(array('level !=' => 'lab'));
		$data['title'] 		  = $this->employee_model->title();
		$data['competence']   = $this->load->view(MODULE_VIEW_PATH.'employee/employee_competence', $data, TRUE);
		$data['training']     = $this->load->view(MODULE_VIEW_PATH.'employee/employee_training', $data, TRUE);
		$data['education']    = $this->load->view(MODULE_VIEW_PATH.'employee/employee_education', $data, TRUE);
		$data['certificate']  = $this->load->view(MODULE_VIEW_PATH.'employee/employee_certificate', $data, TRUE);
		$data['profile']  	  = $this->load->view(MODULE_VIEW_PATH.'profile/profile', $data, TRUE);
		$data['form_password'] = $this->load->view(MODULE_VIEW_PATH.'profile/password', $data, TRUE);

		$this->template->write_view('content', MODULE_VIEW_PATH.'profile/show', $data);
		$this->template->render();
	}

	public function form_password()
	{
		$this->load->view(MODULE_VIEW_PATH.'profile/password');

	}

	public function update_password()
	{
		if($_POST) {
			$old = $this->user->row()->password;
			$old_input = $this->input->post('password_old');
			$new_input = $this->input->post('password');
			$conf_input = $this->input->post('password2');

			if($old != sha1($old_input)) {
				echo 0;

				return FALSE;
			}

			if($new_input != $conf_input) {
				echo 0;

				return FALSE;
			}

			$this->db->where('id_user', $this->input->post('id'));
			$this->db->update('user', array('password' => sha1($new_input)));

			echo 1;

			return FALSE;
		}
	}
}
