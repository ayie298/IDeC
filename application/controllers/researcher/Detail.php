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

	public function view($id = 0)
	{
		if($_POST) {
			if($this->input->post('week')) {
				$this->session->set_userdata('filterWeek', $this->input->post('week'));
				$this->session->set_userdata('filterMonth', $this->input->post('month'));

				return FALSE;
			}
		}

		$projects = $this->project_model->memberProject($id, 'result', array(), array('start_date' => date('Y')));
		$datas	  = "";

		foreach ($projects as $pro) {
			$date_from 	= explode("-", $pro->start_date);
			$date_end  	= explode("-", $pro->end_date);
			$mi_from	= date('n', mktime(0,0,0,$date_from[1], $date_from[2], $date_from[0]));
			$mi_to		= date('n', mktime(0,0,0,$date_end[1], $date_end[2], $date_end[0]));

			$datas .= '{ Project: "'.substr($pro->name, 0, 1).'", M1_From: '.$mi_from.', M1_To: '.$mi_to.' },';
		}

		$project['id_employee']  = $id;
		$project['json_project'] = '['.$datas.'];';
		$project['id_status']	 = 0;

		$data['id_employee']  = $id;
		$data['employee']	  = $this->employee_model->find(array('id_employee' => $id));
		$data['competences']  = $this->employee_model->competence(array('id_employee' => $id));
		$data['education'] 	  = $this->employee_model->education(array('id_employee' => $id));
		$data['training']  	  = $this->employee_model->training(array('id_employee' => $id));
		$data['certificate']  = $this->employee_model->certificateEmp(array('id_employee' => $id));
		$data['project'] 	  = $this->load->view(MODULE_VIEW_PATH.'researcher/researcher_project', $project, TRUE);
		$data['activity']	  = $this->load->view(MODULE_VIEW_PATH.'researcher/researcher_activity', '', TRUE);
		$data['bko']	  	  = $this->load->view(MODULE_VIEW_PATH.'researcher/researcher_bko', $data, TRUE);
		$data['work']	  	  = $this->load->view(MODULE_VIEW_PATH.'researcher/researcher_experience', $data, TRUE);

		$this->template->write_view('content', MODULE_VIEW_PATH.'researcher/researcher_detail', $data);
		$this->template->render();
	}

	public function add_work()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'category',
					'label' => 'Category',
					'rules' => 'required'
				),
				array(
					'field' => 'type',
					'label' => 'Type',
					'rules' => 'required'
				),
				array(
					'field' => 'desc',
					'label' => 'Desc',
					'rules' => 'required'
				),
				array(
					'field' => 'start_year',
					'label' => 'Start Year',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'end_year',
					'label' => 'End Year',
					'rules' => 'required|numeric'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {
				$data = array(
					'id_employee' 			=> $this->input->post('id_emp'),
					'job_desk'				=> $this->input->post('desc'),
					'start_year'			=> $this->input->post('start_year'),
					'end_year'				=> $this->input->post('end_year'),
					'id_mas_times_category'	=> $this->input->post('category'),
					'description'			=> $this->input->post('desc'),
					'work_type'				=> $this->input->post('type')
				);

				if($this->input->post('id_work') == 0) {
					$this->db->insert('work_experience', $data);
				} else {
					$this->db->where('id_work_experience', $this->input->post('id_work'));
					$this->db->update('work_experience', $data);
				}

				$datas['notice'] = 'Data berhasil disimpan';
				$datas['error']	 = 0;

			} else {
				$datas['notice'] = validation_errors();
				$datas['error']	= 1;
			}

			echo json_encode($datas);

			return FALSE;
		}

		$id = $this->input->get('id') == 0 ? '' : $this->input->get('id');

		if(!empty($id)) {
			$employee	= $this->researcher_model->workEmployee(array('id_work_experience' => $id), array(), 'row');
		}

		$data['id_emp']		  = $this->input->get('id_emp');
		$data['id_work'] 	  = $this->input->get('id');
		$data['employee']	  = $this->employee_model->find(array('id_employee' => $this->input->get('id_emp')));
		$data['times'] 	  	  = $this->idec_model->findMaster('mas_times_category');
		$data['bko']		  = !empty($employee) ? $employee : '';

		$this->load->view(MODULE_VIEW_PATH.'researcher/researcher_add_experience', $data);
	}

	public function add_bko()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'unit',
					'label' => 'Unit',
					'rules' => 'required'
				),
				array(
					'field' => 'position',
					'label' => 'Position',
					'rules' => 'required'
				),
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required'
				),
				array(
					'field' => 'year',
					'label' => 'Year',
					'rules' => 'required|numeric'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {
				$data = array(
					'id_employee' 				=> $this->input->post('id_emp'),
					'id_organization_item'		=> $this->input->post('lab') == "" ? $this->input->post('unit') : $this->input->post('lab'),
					'id_mas_title'				=> $this->input->post('title'),
					'id_mas_employee_position' 	=> $this->input->post('position'),
					'year'						=> $this->input->post('year')
				);

				if($this->input->post('id_bko') == 0) {
					$this->db->insert('bko_history', $data);
				} else {
					$this->db->where('id_bko_history', $this->input->post('id_bko'));
					$this->db->update('bko_history', $data);
				}

				$datas['notice'] = 'Data berhasil disimpan';
				$datas['error']	 = 0;

			} else {
				$datas['notice'] = validation_errors();
				$datas['error']	= 1;
			}

			echo json_encode($datas);

			return FALSE;
		}

		$id = $this->input->get('id') == 0 ? '' : $this->input->get('id');

		if(!empty($id)) {
			$employee	= $this->researcher_model->bkoEmployee(array('id_bko_history' => $id), array(), 'row');
			$labs		= $this->employee_model->organization(array('id_organization_item' => $employee->id_organization_item, 'level' => 'lab'), 'row');

			$data['labs']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item_parent' => $labs->id_organization_item_parent, 'level' => 'lab')) : array();
			$data['unit']	 = !empty($labs) ? $labs->id_organization_item_parent : $employee->id_organization_item;
		}

		$data['id_emp']		  = $this->input->get('id_emp');
		$data['id_bko'] 	  = $this->input->get('id');
		$data['employee']	  = $this->employee_model->find(array('id_employee' => $this->input->get('id_emp')));
		$data['organization'] = $this->employee_model->organization(array('level !=' => 'lab'));
		$data['title'] 		  = $this->employee_model->title();
		$data['position'] 	  = $this->idec_model->findMaster('mas_employee_position');
		$data['bko']		  = !empty($employee) ? $employee : '';

		$this->load->view(MODULE_VIEW_PATH.'researcher/researcher_add_bko', $data);
	}

	public function delete()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_bko_history', $id);
			$this->db->delete('bko_history');
		}
	}

	public function delete_work()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_work_experience', $id);
			$this->db->delete('work_experience');
		}
	}

	public function project_json($id = 0)
	{
		$data  = array();
		$filter = array();
		$filterCount = array();
		$year  = date('Y');
		$filterLike = array('start_date' => $year);

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'team') {
					$filterCount[$field] = $value;
				} else {
					$filterLike[$field] = $value;
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$steps = $this->project_model->memberProject($id, 'result', array(), $filterLike);

		foreach($steps as $step) {
			$data[] = array(
				'id'   		=> (int) $step->id_project,
				'id_encrypt'=> md5($step->id_project),
				'name'		=> $step->name,
				'org_name'	=> $step->org_name,
				'start_date'=> $step->start_date,
				'end_date'	=> $step->end_date,
				'status'	=> $step->status,
				'percent_progress'	=> $step->percent_progress,
				'position'	=> $step->position
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('searchYear');
	}

	public function bko_json($id = 0)
	{
		$data = array();
		$filter = array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field, $value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$employes = $this->researcher_model->bkoEmployee(array('id_employee' => $id), $filterLike);

		foreach($employes as $employee) {
			$labs		= $this->employee_model->organization(array('id_organization_item' => $employee->id_organization_item, 'level' => 'lab'), 'row');
			$unit		= !empty($labs) ? $this->employee_model->organization(array('id_organization_item' => $labs->id_organization_item_parent), 'row') : NULL;

			$data[] = array(
				'id'   			=> $employee->id_bko_history,
				'id_employee'	=> $employee->id_employee,
				'org_name'		=> !empty($unit) ? $unit->org_name : $employee->org_name,
				'bagian_org'	=> !empty($labs) ? $labs->org_name : '',
				'year' 			=> (int) $employee->year,
				'title'			=> $employee->title
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function work_json($id = 0)
	{
		$data = array();
		$filter = array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field, $value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$employes = $this->researcher_model->workEmployee(array('id_employee' => $id), $filterLike);

		foreach($employes as $employee) {

			$data[] = array(
				'id'   			=> $employee->id_work_experience,
				'id_employee'	=> $employee->id_employee,
				'start_year'	=> (int) $employee->start_year,
				'end_year'		=> (int) $employee->end_year,
				'category'		=> $employee->category,
				'work_type'		=> ucfirst($employee->work_type),
				'job_desk'		=> $employee->job_desk
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
