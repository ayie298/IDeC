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
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/researcher/researcher_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		if($_POST && $this->input->is_ajax_request())
		{
			$this->session->set_userdata('showPrime', $this->input->post('prime'));
			$this->session->set_userdata('filterName', $this->input->post('name'));
			$this->session->set_userdata('filterYear', $this->input->post('year'));
		}

		$this->template->write_view('content', MODULE_VIEW_PATH.'program/program');
		$this->template->render();
	}

	public function delete($id = "")
	{
		$this->db->where('md5(id_program)', $id);

		$this->db->delete('program');

		$this->session->set_flashdata('notice', 'Program deleted');

		redirect('program');
	}

	public function json($id = 0)
	{
		$data	 	= array();
		$filter  	= array();
		$filterLike	= array();

		if($this->session->userdata('showPrime') != '') {
			$filter['primary_program'] = 1;
		}

		if($this->session->userdata('filterName') != '') {
			$filterLike['program.name'] = $this->session->userdata('filterName');
		}

		if($this->session->userdata('filterYear') != '') {
			$filterLike['program.start_date'] = $this->session->userdata('filterYear');
		}

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$field = $field == 'bagian_org' ? 'org_name' : $field;
				
				$filterLike[$field] = $value;
			}

			if(!empty($ord)) {
				$ord = $ord == 'bagian_org' ? 'org_name' : $ord;

				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$program = $this->program_model->findAll($filter, array(), $filterLike);

		foreach($program as $prog) {
			$labs		= $this->employee_model->organization(array('id_organization_item' => $prog->id_organization_item, 'level' => 'lab'), 'row');
			$unit		= !empty($labs) ? $this->employee_model->organization(array('id_organization_item' => $labs->id_organization_item_parent), 'row') : NULL;

			$data[] = array(
				'id'   			=> (int) $prog->id_program,
				'id_encrypt'   	=> md5($prog->id_program),
				'org_name'		=> !empty($unit) ? $unit->org_name : $prog->org_name,
				'program.name'	=> $prog->name,
				'bagian_org'	=> !empty($labs) ? $labs->org_name : '',
				'output' 		=> $prog->output,
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('showPrime');
		$this->session->unset_userdata('filterName');
		$this->session->unset_userdata('filterYear');
	}
}
