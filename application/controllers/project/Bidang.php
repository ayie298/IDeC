<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends CI_Controller {

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

	public function index()
	{
		if($_POST) {
			$this->session->set_userdata('unit', $this->input->post('unit'));
			$this->session->set_userdata('unitYear', $this->input->post('year'));

			return FALSE;
		}

		$this->db->order_by('org_name', 'ASC');

		$data['unit'] = $this->employee_model->organization(array('level' => 'subunit'));
		
		$this->template->write_view('content', MODULE_VIEW_PATH.'project/project_bidang', $data);
		$this->template->render();
	}

	public function bidang_json($id = 0)
	{
		$data	  	= array();
		$filter 	= array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$id = $this->session->userdata('unit') == '' ? 4 : $this->session->userdata('unit');
		$date = $this->session->userdata('unitYear') == '' ? date('Y') : $this->session->userdata('unitYear');

		$activity = $this->researcher_model->findAll(array('org.id_organization_item' => $id), array('org.id_organization_item_parent' => $id));

		foreach($activity as $act) {
			$findProject = $this->project_model->memberProject($act->id_employee, 'row', array(), array('start_date' => $date));

			if(!empty($findProject)) {
				$data[] = array(
					'id'   			=> (int) $act->id_employee,
					'nik'			=> $act->nik,
					'parent'		=> "",
					'researcher'    => $act->name,
					'title'			=> $act->title,
					'project'		=> $findProject->name,
					'owner'			=> strtoupper($findProject->org_name)
				);

				$findResProject = $this->project_model->memberProject($act->id_employee, 'result', array('employee_project.id_project !=' => $findProject->id_project), array('start_date' => $date));

				foreach($findResProject as $prj) :
					$data[] = array(
						'id'   			=> (int) $prj->id_project,
						'parent'		=> (int) $act->id_employee,
						'project'		=> $prj->name,
						'owner'			=> strtoupper($prj->org_name)
					);
				endforeach;
			}
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('unitYear');
	}
}
