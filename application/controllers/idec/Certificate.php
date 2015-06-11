<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('idec_model');

		$this->template->set_template('login');
	}

	public function add($id = "", $id_cer = "")
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				),
				array(
					'field' => 'category',
					'label' => 'Category',
					'rules' => 'required'
				),
				array(
					'field' => 'tanggal2',
					'label' => 'Expired Date',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {

				$data['id_employee']		= $this->input->post('id');
				$data['id_certificate']  	= $this->input->post('category');
				$data['expired_date']  		= $this->input->post('tanggal2');
				$data['cer_name']			= $this->input->post('name');

				$upload = $this->files->uploads('userfile', 'jpg|pdf|jpeg');

				if((!empty($upload['error']) || $upload['error'] == 1) && !empty($_FILES['userfile']['name'])) {
					$this->session->set_flashdata('notice',$upload['message']);

					redirect('idec/employee/edit/' . md5($this->input->post('id')));

					return FALSE;
				}

				if(!empty($_FILES['userfile']['name'])) {
					$data['file_upload'] = $upload['filename'];
				}

				if($this->input->post('id_cer') == ""){
					$this->db->insert('certificate_employee', $data);
				} else {
					$this->db->where('id_certificate_employee', $this->input->post('id_cer'));
					$this->db->update('certificate_employee', $data);
				}

				$this->session->set_flashdata('notice','Data berhasil disimpan');
			} else {
				$this->session->set_flashdata('notice',validation_errors());
			}

			redirect('idec/employee/edit/' . md5($this->input->post('id')));

			return FALSE;
		}

		$data['title'] 			= empty($id_cer) ? 'Add' : 'Edit';
		$data['certificate']	= $this->idec_model->findMaster('certificate');
		$data['sertifikat']		= $this->employee_model->certificateEmp(array('id_certificate_employee' => $id_cer), 'row');
		$data['id_employee']	= $id;

		$this->load->view(MODULE_VIEW_PATH.'employee/employee_certificate_add', $data);
	}

	public function delete()
	{
		if($_POST){
			$this->db->where('id_certificate_employee', $this->input->post('id'));
			$this->db->delete('certificate_employee');

			$this->session->set_flashdata('notice', 'Competence deleted');
		}

		//redirect('idec/employee/edit/' . md5($id_emp));
	}
}
