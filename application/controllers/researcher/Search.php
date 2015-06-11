<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/researcher/researcher_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		if($_POST) {
			$this->session->set_userdata('unit', $this->input->post('unit'));
			$this->session->set_userdata('comptSearch', $this->input->post('competence'));
			$this->session->set_userdata('nameSearch', $this->input->post('name'));
			$this->session->set_userdata('nikSearch', $this->input->post('nik'));
		}
		
		$data['post']			= $_POST;
		$data['organization'] 	= $this->employee_model->organization(array('level' => 'subunit'));
		$data['competence']		= $this->employee_model->getCompetence();

		$this->template->write_view('content', MODULE_VIEW_PATH.'researcher/researcher_search', $data);
		$this->template->render();
	}

	public function get_researcher()
	{
		if($this->input->is_ajax_request()) {
			$idUnit = $this->input->post('unit');
			$idEmp = $this->input->post('emp');
			$labs 	= $this->employee_model->findAll(array('employee.id_organization_item' => $idUnit, 'employee.id_mas_employee_position' => 1));

			echo '<option value="">Choose Researcher</option>';

			foreach($labs as $lab) :
				$select = $lab->id_employee == $idEmp ? 'selected' : '';
				echo '<option value="'.$lab->id_employee.'" '.$select.'>' . $lab->name . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}

	public function json_output()
	{
		$position 	 = $this->employee_model->position(array('position' => 'RESEARCHER'));
		$id_position = $position[0]->id_mas_employee_position;
		$filterOR 	 = array();
		$filterLike  = array();
		$filterCount = array();


		if($this->session->userdata('unit') != "") {
			$filter['employee.id_organization_item'] = $this->session->userdata('unit');

			$org = $this->employee_model->organization(array('id_organization_item_parent' => $this->session->userdata('unit')));

			foreach($org as $org) :
				$filterOR['employee.id_organization_item'][] = $org->id_organization_item;
			endforeach;
		}

		if($this->session->userdata('comptSearch') != "") {
			$competence = $this->session->userdata('comptSearch');

			for($i=0;$i<sizeof($competence);$i++) {
				$search = $this->idec_model->findMaster('mas_competence', array('where' => 'name = "' . $competence[$i] .'"'), 'row');

				$filterOR['competence_employee.id_mas_competence'][] = $search->id_mas_competence;
			}

			$this->db->join('competence_employee', 'competence_employee.id_employee = employee.id_employee');
		}

		if($this->session->userdata('nikSearch') != "") {
			$filter['employee.nik'] = $this->session->userdata('nikSearch');
		}

		if($this->session->userdata('trainSearch') != "") {
			$search = $this->idec_model->findMaster('training', array('like' => 'name,' . $this->session->userdata('trainSearch')));

			foreach($search as $s) {
				$filterOR['training_employee.id_training'][] = $s->id_training;
			}
		}

		if($this->session->userdata('nameSearch') != "") {
			$filterLike['employee.name'] = $this->session->userdata('nameSearch');
		}

		if($this->session->userdata('sertSearch') != "") {
			$filter['employee.id_organization_item'] = $this->session->userdata('sertSearch');
		}

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'project' || $field == 'close') {
					$field = $field == 'project' ? '(SELECT COUNT(id_mas_project_status) FROM project JOIN employee_project as emp ON emp.id_project = project.id_project WHERE emp.id_employee = employee.id_employee && project.id_mas_project_status = 1) = ' : '(SELECT COUNT(id_mas_project_status) FROM project JOIN employee_project as emp ON emp.id_project = project.id_project WHERE emp.id_employee = employee.id_employee && project.id_mas_project_status = 2) = ';
					$filter[$field] = $value;
				} else {
					$filterLike[$field] = $value;
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$filter['employee.id_mas_employee_position'] = $id_position;

		$employee 	 = $this->researcher_model->findAllResProject($filter, $filterOR, $filterLike);
		$data 		 = array();

		foreach($employee as $employee) {
				$data[] = array(
					'id'   		=> md5($employee->id_employee),
					'id_real'	=> $employee->id_employee,
					'nik'  		=> $employee->nik,
					'name' 		=> $employee->name,
					'position'	=> $employee->position,
					'project'	=> (int) $employee->project,
					'activity'	=> '',
					'close'		=> (int) $employee->close,
					'org_name'	=> $employee->org_name
				);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('comptSearch');
		$this->session->unset_userdata('nameSearch');
		$this->session->unset_userdata('nikSearch');
		$this->session->unset_userdata('sertSearch');
		$this->session->unset_userdata('trainSearch');
	}
}
