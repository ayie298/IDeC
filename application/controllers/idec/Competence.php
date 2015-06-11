<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competence extends CI_Controller {

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

	public function add($id = "")
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'competence[]',
					'label' => 'Competence',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {
				$competence = $this->input->post('competence');

				$data['id_employee']		= $this->input->post('id');
				$data['id_mas_competence']  = $competence;
				$data['description']		= $this->input->post('desc');

				if($this->input->post('id_comp') == "") {
					$data['id_competence_employee'] = $this->program_model->getAutoIncrement('competence_employee', 'id_competence_employee');
					$this->db->insert('competence_employee', $data);
				} else {
					$this->db->where('id_competence_employee', $this->input->post('id_comp'));
					$this->db->update('competence_employee', $data);
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

		$id_mas = $this->input->get('id_comp') == "" ? "" : $this->input->get('id_comp');

		$data['title'] 			= $this->input->get('id_comp') == "" ? 'Add' : 'edit';
		$data['competence']		= $this->employee_model->getCompetence();
		$data['competence_emp']	= $this->employee_model->competence(array('id_competence_employee' => $id_mas), array(), 'row');
		$data['id_employee']	= $id;

		$this->load->view(MODULE_VIEW_PATH.'employee/employee_competence_add', $data);
	}

	public function delete($id_emp, $id)
	{
		$this->db->where('id_competence_employee', $id);
		$this->db->delete('competence_employee');

		$this->session->set_flashdata('notice', 'Competence deleted');

		redirect('idec/employee/edit/' . md5($id_emp));
	}
}
