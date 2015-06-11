<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

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

	public function index($id = null)
	{
		$program	= $this->program_model->find(array('md5(id_program)' => $id));
		$labs		= $this->employee_model->organization(array('id_organization_item' => $program->id_organization_item, 'level' => 'lab'), 'row');
		$po   		= $this->employee_model->find(array('id_employee' => $program->id_employee_po));
		$pm   		= $this->employee_model->find(array('id_employee' => $program->id_employee_pm));
		$tw 		= array();

		$data['program'] = $program;
		$data['lab']	 = !empty($labs) ? $labs->org_name : NULL;
		$data['unit']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item' => $labs->id_organization_item_parent), 'row')->org_name : $program->org_name;
		$data['pm']		 = !empty($program->id_employee_pm) ? $pm->name : NULL;
		$data['po']		 = !empty($program->id_employee_po) ? $po->name : NULL;

		for($i=1;$i<=4;$i++) {
			switch ($i) {
				case '1':
					$period = 'TW I';
				break;
				case '2':
					$period = 'TW II';
				break;
				case '3':
					$period = 'TW III';
				break;
				case '4':
					$period = 'TW IV';
				break;
			}

			echo $period;

			$data['target']  = $this->program_model->getTarget($program->id_program, $period);

			$tw[] = $this->load->view(MODULE_VIEW_PATH.'program/program_tw_detail', $data, TRUE);
		}

		$data['tw'] 			= $tw;
		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));
		$data['status']			= $this->idec_model->findMaster('mas_project_status', array('where' => 'id_mas_project_status = ' . $program->id_mas_project_status), 'row');
		$data['resType']		= $this->idec_model->findMaster('mas_research_type');
		$data['title']			= !empty($id) && $id !== 'index' ? 'Edit' : 'Add';

		$this->template->write_view('content', MODULE_VIEW_PATH.'program/program_detail', $data);
		$this->template->render();
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