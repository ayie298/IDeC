<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

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

	public function add($id = "")
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
					'field' => 'tanggal1',
					'label' => 'Expired Date',
					'rules' => 'required'
				),
				array(
					'field' => 'organizer',
					'label' => 'Organizer',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {

				$data['organizer']  			= $this->input->post('organizer');
				$data['start_time']  			= $this->input->post('tanggal1');
				$data['name']					= $this->input->post('name');
				$data['id_mas_training_type']	= $this->input->post('type');
				$data['id_mas_times_category']	= $this->input->post('category');

				if($this->input->post('id_train') == "") {
					$this->db->insert('training', $data);

					$last_id = $this->db->insert_id();

					$data_emp = array(
						'id_employee' => $this->input->post('id'),
						'id_training' => $last_id
					);

					$this->db->insert('training_employee', $data_emp);
				} else {
					$this->db->where('id_training', $this->input->post('id_train'));
					$this->db->update('training', $data);
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

		$id_mas = $this->input->get('id_train') == "" ? "" : $this->input->get('id_train');

		$data['training_emp']	= array();

		if(!empty($id_mas)) {
			$data['training_emp']	= $this->employee_model->training(array('id_training_employee' => $id_mas), 'row');
		}

		$data['title'] 			= $this->input->get('id_comp') == "" ? 'Add' : 'edit';
		$data['type']			= $this->idec_model->findMaster('mas_training_type');
		$data['category']		= $this->idec_model->findMaster('mas_times_category');
		$data['id_employee']	= $id;

		$this->load->view(MODULE_VIEW_PATH.'employee/employee_training_add', $data);
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if(!empty($id)) {
			$this->db->where('id_training_employee', $id);
			$this->db->delete('training_employee');
		}
	}
}
