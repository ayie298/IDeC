<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_member extends CI_Controller {

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

	public function add($id = 0)
	{
		if($_POST) {
			if($this->input->is_ajax_request()) {
				$this->session->set_userdata('unit', $this->input->post('unit'));
				$this->session->set_userdata('comptSearch', $this->input->post('competence'));
				$this->session->set_userdata('nameSearch', $this->input->post('name'));
				$this->session->set_userdata('nikSearch', $this->input->post('nik'));

				return FALSE;
			}
		}

		$data['organization'] 	= $this->employee_model->organization(array('level' => 'unit'));
		$data['status']			= $this->idec_model->findMaster('mas_project_status');
		$data['competence']		= $this->idec_model->findMaster('mas_competence');
		$data['id_project']		= $id;

		$this->load->view(MODULE_VIEW_PATH.'project/project_add_member', $data);
	}

	public function select()
	{	
		$where = array('employee_project.id_project' => $this->input->post('id_project'), 'employee_project.id_employee' => $this->input->post('id'));
		$stat = $this->project_model->findMemberAll($where);

		if($this->input->post('btn_pilih')) {
			$data['id_project'] = $this->input->post('id_project');
			$data['id_employee']= $this->input->post('id');
			$data['id_mas_employee_project_position'] = $this->input->post('position');

			if($this->input->post('id_emp_proj') == 0) {
				$insert = $this->db->insert('employee_project', $data);
			} else {
				$this->db->where('id_employee_project', $this->input->post('id_emp_proj'));

				$insert = $this->db->update('employee_project', $data);
			}

			if($insert) {
				$this->session->set_flashdata('notice', 'Member has been added');
			} else {
				$this->session->set_flashdata('notice', 'Something wrong!, please try again');
			}

			redirect('researcher/project/update/' . md5($this->input->post('id_project')));
		}

		$data['employee'] 	= $this->employee_model->find(array('employee.id_employee' => $this->input->post('id')));
		$data['position']	= $this->idec_model->findMaster('mas_employee_project_position');
		$data['id_project']	= $this->input->post('id_project');
		$data['cur_pos']	= !empty($stat) ? $stat[0]->id_mas_employee_project_position : 0;
		$data['id_emp_pro']	= !empty($stat) ? $stat[0]->id_employee_project : 0;

		$this->load->view(MODULE_VIEW_PATH.'project/project_member_select_project', $data);
	}

	public function ongoing()
	{
		$project = $this->project_model->memberProject($this->input->post('id_emp'), 'result', array('project.id_mas_project_status' => $this->input->post('status')), array('start_date' => date('Y')));
		$datas	 = "";

		foreach ($project as $pro) {
			$date_from 	= explode("-", $pro->start_date);
			$date_end  	= explode("-", $pro->end_date);
			$mi_from	= date('n', mktime(0,0,0,$date_from[1], $date_from[2], $date_from[0]));
			$mi_to		= date('n', mktime(0,0,0,$date_end[1], $date_end[2], $date_end[0]));

			$datas .= '{ Project: "'.substr($pro->name, 0, 1).'", M1_From: '.$mi_from.', M1_To: '.$mi_to.' },';
		}

		$data['id_employee']  = $this->input->post('id_emp');
		$data['id_status']    = $this->input->post('status');
		$data['json_project'] = '['.$datas.'];';

		$this->load->view(MODULE_VIEW_PATH.'researcher/researcher_activity_detail', $data);
	}

	public function ongoing_json($id = 0, $status = 0)
	{
		if($this->session->userdata('filterWeek') != '') {
				$month = $this->session->userdata('filterMonth');

				switch ($this->session->userdata('filterWeek')) {
					case '1':
						$this->db->where('activity_start_date >=', date('Y').'-'.$month.'-01');
						$this->db->where('activity_start_date <=', date('Y').'-'.$month.'-07');
						break;

					case '2':
						$this->db->where('activity_start_date >=', date('Y').'-'.$month.'-08');
						$this->db->where('activity_start_date <=', date('Y').'-'.$month.'-14');
						break;

					case '3':
						$this->db->where('activity_start_date >=', date('Y').'-'.$month.'-15');
						$this->db->where('activity_start_date <=', date('Y').'-'.$month.'-21');
						break;

					case '4':
						$this->db->where('activity_start_date >=', date('Y').'-'.$month.'-22');
						break;
					
					default:
						# code...
						break;
				}
			}

		$data 	  = array();
		$filterLike  = array();

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

		$activity = $this->project_model->activityLog(0, array('employee_project.id_employee' => $id));

		foreach($activity as $act) {
			if($status > 0) {
				$project = $this->project_model->find(array('id_project' => $act->id_project, 'project.id_mas_project_status' => $status));
			} else {
				$project = $this->project_model->find(array('id_project' => $act->id_project));
			}

			if(!empty($project)) {

			$data[] = array(
				'id'   					=> (int) $act->id_employee_activity_log,
				'id_encrypt'   			=> md5($act->id_employee_activity_log),
				'step_name'				=> $act->step_name,
				'pr.name'				=> '('.substr($project->name, 0, 1).') '.$project->name,
				'nik'					=> $act->nik,
				'activity_detail' 		=> $act->activity_detail,
				'step.weight' 			=> $act->weight,
				'position'				=> $act->position,
				'activity_start_date'	=> $act->activity_start_date,
				'activity_end_date'		=> $act->activity_end_date,
				'pr.percent_progress'	=> (int) $act->percent_progress,
				'status'				=> $act->status
			);

			}
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('filterWeek');
		$this->session->unset_userdata('filterMonth');
	}

	public function researcher_json($id = 0)
	{
		$position 	 = $this->employee_model->position(array('position' => 'RESEARCHER'));
		$id_position = $position[0]->id_mas_employee_position;
		$filterOR 	 = array();
		$filterLike  = array();

		$filter['employee.id_mas_employee_position'] = $id_position;

		if($this->session->userdata('unit') != "") {
			$filter['employee.id_organization_item'] = $this->session->userdata('unit');
		}

		if($this->session->userdata('comptSearch') != "") {
			$competence = $this->session->userdata('comptSearch');

			for($i=0;$i<sizeof($competence);$i++) {
				$filterOR['competence_employee.id_mas_competence'][] = $competence[$i];
			}
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

		$data  	 = array();
		$members = $this->researcher_model->findAll($filter, $filterOR, $filterLike);

		foreach($members as $member) {
			$status 	= $this->project_model->memberProject($member->id_employee);
			$statusEmp	= $this->project_model->memberProject($member->id_employee, 'num_rows', array('employee_project.id_project' => $id, 'employee_project.id_employee' => $member->id_employee));
			$i 			= !empty($status->ongoing) ? ($status->ongoing/25)*100 : 0;

			if($i>100) { $i = 100; }

			if($i > 85){
				$color = "#ff6600";
			}else if($i>75){
				$color = "#ffff00";
			}else if($i>65){
				$color = "#ffcc00";
			}else{
				$color = "#00cc00";
			}

			if($statusEmp == 0) {
			$data[] = array(
				'id' 		=> $member->id_employee,
				'nik'		=> $member->nik,
				'nama'		=> $member->name,
				'unit'		=> $member->abbreviation,
				'loads' 	=> (int) $i,
				'color' 	=> $color,
				'project' 	=> !empty($status->ongoing) ? (int) $status->ongoing : 0,
				'close'	  	=> !empty($status->close) ? (int) $status->close : 0,
				'id_project'=> (int) $id
			);
			}
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
