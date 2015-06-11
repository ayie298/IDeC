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

		$this->template->write_view('content', MODULE_VIEW_PATH.'review/review');
		$this->template->render();
	}

	public function json($id = 0)
	{
		$data 		 = array();
		$filter 	 = array();
		$filterLike  = array();
		$filterCount = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$field = $field == 'bagian' ? 'org_name' : $field;

				if($field == 'review' || $field == 'date') {
					$filterCount[$field] = $value;
				} else {
					$filterLike[$field] = $value;
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		if($this->session->userdata('showPrime') != '') {
			$filter['primary_program'] = 1;
		}

		if($this->session->userdata('filterName') != '') {
			$filterLike['program.name'] = $this->session->userdata('filterName');
		}

		if($this->session->userdata('filterYear') != '') {
			$filterLike['program.start_date'] = $this->session->userdata('filterYear');
		}

		$this->db->order_by('id_program', 'ASC');
		$program = $this->program_model->findAll($filter, array(), $filterLike);

		foreach($program as $prog) {
			$labs		= $this->employee_model->organization(array('id_organization_item' => $prog->id_organization_item, 'level' => 'lab'), 'row');
			$unit		= !empty($labs) ? $this->employee_model->organization(array('id_organization_item' => $labs->id_organization_item_parent), 'row') : NULL;
			$review		= $this->db->where('id_program', $prog->id_program)->get('review_management')->num_rows();
			$date		= !empty($filterCount['date']) ? $this->db->like('date', $filterCount['date'])->where('id_program', $prog->id_program)->order_by('date', 'DESC')->get('review_management')->row() : $this->db->where('id_program', $prog->id_program)->order_by('date', 'DESC')->get('review_management')->row();
			$date 		= !empty($date) ? explode(" ", $date->date) : '';

			if(!empty($filterCount['review'])) {
				if($review == $filterCount['review']) {
				$data[] = array(
					'id'   			=> (int) $prog->id_program,
					'id_encrypt'   	=> md5($prog->id_program),
					'org_name'		=> !empty($unit) ? $unit->org_name : $prog->org_name,
					'program.name'	=> $prog->name,
					'bagian'		=> !empty($labs) ? $labs->org_name : '',
					'review' 		=> (int) $review,
					'date'			=> !empty($date) ? $date[0] : ''
				);
				}
			} else {
				$data[] = array(
					'id'   			=> (int) $prog->id_program,
					'id_encrypt'   	=> md5($prog->id_program),
					'org_name'		=> !empty($unit) ? $unit->org_name : $prog->org_name,
					'program.name'	=> $prog->name,
					'bagian'		=> !empty($labs) ? $labs->org_name : '',
					'review' 		=> (int) $review,
					'date'			=> !empty($date) ? $date[0] : ''
				);
			}
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
