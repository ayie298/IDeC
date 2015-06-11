<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));
		$data['competence']		= $this->employee_model->getCompetence();

		if($this->user->row()->level_name == "researcher"){
//			$this->researcher_detail();
			$this->template->write_view('content', MODULE_VIEW_PATH.'researcher/researcher', $data);
		}else{
			$this->template->write_view('content', MODULE_VIEW_PATH.'researcher/researcher', $data);
		}

		$this->template->render();
	}
}
