<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual extends CI_Controller {

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
		$this->template->write_view('content', MODULE_VIEW_PATH.'idec/annual');
		$this->template->render();
	}

	public function json()
	{
		$data 	= array();
		$jumlah = 0;
		$result = $this->idec_model->findMaster('annual_data', array('order_by' => 'year DESC'));

		foreach($result as $res) {
			if($res->url == 'performance'  || $res->url == 'pms/performance') {
				$jumlah = $this->db->like('date', $res->year)->get('performance_system')->num_rows();
			}

			if($res->url == 'program'  || $res->url == 'pms/program') {
				$jumlah = $this->db->like('start_date', $res->year)->get('program')->num_rows();
			}

			if($res->url == 'researcher/project'  || $res->url == 'pms/researcher/project') {
				$jumlah = $this->db->like('start_date', $res->year)->get('project')->num_rows();
			}

			if($res->url == 'review' || $res->url == 'pms/review') {
				//$this->db->join('employee_activity_log as log', 'log.id_employee_project = employee_project.id_employee_project');

				$this->db->join('program', 'program.id_program = review_management.id_program');
				$jumlah = $this->db->like('date', $res->year)->get('review_management')->num_rows();
			}

			$data[] = array(
				'thn' 		 => $res->year,
				'keterangan' => $res->name,
				'url' 		 => $res->url,
				'jml' 		 => (int) $jumlah
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
