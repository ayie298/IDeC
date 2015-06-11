<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/research/research_model');
	}
	 
	public function index()
	{
		$this->template->write_view('content', MODULE_VIEW_PATH.'research/research');
		$this->template->render();
	}

	public function json()
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

		$activity = $this->research_model->findAll();

		foreach($activity as $act) {
			$data[] = array(
				'id'   				=> (int) $act->id_research,
				'id_encrypt'   		=> md5($act->id_research),
				'executive_summary'	=> $act->executive_summary,
				'document_upload'	=> $act->document_upload,
				'title'				=> $act->title,
				'number'			=> $act->number,
				'org_name'			=> $act->org_name,
				'research_team'		=> $act->research_team,
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}	
		