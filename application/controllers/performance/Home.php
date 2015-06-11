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
		$this->load->model('modules/performance/performance_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		$date = $this->input->post('year') ? $this->input->post('year') : date('Y');

		$data['performance'] = $this->performance_model->findAll('getPerformance', array(), array(), array('date' => $date), 3, array('id_performance_system','DESC'));
		$data['perspective'] = $this->performance_model->findAll('getPerspective');
		$data['batasAtas']	 = 105;
		$data['batasBawah']	 = 60;
		$data['date']		 = $date;

		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance', $data);
		$this->template->render();
	}

	public function test()
	{
		$a = $this->performance_model->getSumPeriode(1, 1);

		echo $a->total_achieve;
	}

	public function json()
	{
		$data 	= array();
		$filter = array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);
				
				$filterLike[$field] = $value;
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$employee 	 = $this->performance_model->findAll('getPerformance', array(), array(), $filterLike);

		foreach($employee as $employee) {
			$data[] = array(
				'id'		=> $employee->id_performance_system,
				'id_encrypt'=> md5($employee->id_performance_system),
				'perform_name'	=> $employee->perform_name,
				'date'		=> $employee->date
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
