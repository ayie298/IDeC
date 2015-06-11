<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		$this->db->order_by('row', 'ASC');

		$data['organization'] = $this->employee_model->organization(array('level' =>'unit'));

		$this->template->write_view('content', MODULE_VIEW_PATH.'idec/organization', $data);
		$this->template->render();
	}

	public function detail()
	{
		if($_POST) {
			$id 	= $this->input->post('id');
			$level	= $this->input->post('level');

			$filterOr['id_organization_item_parent'] = $this->input->post('id');

			if($level == 'unit') {
				$id = $id == 2 ? 2 : 3;

				$data['employee'] = $this->employee_model->findAll(array('employee.id_mas_employee_position' => $id));
			} else {
				$data['employee'] = $this->employee_model->findAll(array('employee.id_organization_item' => $id), $filterOr);
			}

			$data['bidang'] = $this->employee_model->organization(array('id_organization_item' => $this->input->post('id')), 'row', array('id_organization_item_parent' => $this->input->post('id')));

			$this->load->view(MODULE_VIEW_PATH.'idec/organization_detail', $data);
		}
	}

	public function tree()
	{
		$data['organization'] = $this->employee_model->organization(array('row' => 1));

		$this->load->view(MODULE_VIEW_PATH.'idec/chart', $data);
	}
}
