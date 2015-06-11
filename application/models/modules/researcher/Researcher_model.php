<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Researcher_model extends CI_Model {

	public $table = 'employee';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->getEmployee('row');
	}

	public function findAll($where = array(), $whereOR = array(), $whereLike = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereOR)) {
			$queryOr = "";

			foreach($whereOR as $key => $value) {
				if(is_array($whereOR[$key])) {
					for($j=0;$j<sizeof($whereOR[$key]);$j++) {
						$queryOr .= $key . ' = ' . $whereOR[$key][$j] . ' OR ';
					}

					$this->db->or_where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');

				} else {
					$this->db->or_where($whereOR);
				}
			}
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		return $this->getEmployee();
	}

	public function filter($where = array(), $whereOR = array(), $whereLike = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereOR)) {
			$queryOr = "";

			foreach($whereOR as $key => $value) {
				if(is_array($whereOR[$key])) {
					for($j=0;$j<sizeof($whereOR[$key]);$j++) {
						$queryOr .= $key . ' = ' . $whereOR[$key][$j] . ' OR ';
					}

					$this->db->or_where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');

				} else {
					$this->db->or_where($whereOR);
				}
			}
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}
	}

	public function getEmployee($type = 'result')
	{
//		$this->db->where('employee.id_mas_employee_position',1);
		$this->db->join('organization_item as org', 'org.id_organization_item = employee.id_organization_item');
		$this->db->join('mas_bp', 'mas_bp.id_mas_bp = employee.id_mas_bp');
		$this->db->join('mas_title', 'mas_title.id_mas_title = employee.id_mas_title', 'LEFT');
		$this->db->join('mas_employee_position as epos', 'epos.id_mas_employee_position = employee.id_mas_employee_position');
		$this->db->group_by('employee.id_employee');

		return $this->db->get($this->table)->{$type}();
	}

	public function findAllResProject($where = array(), $whereOR = array(), $whereLike = array())
	{
//		$this->db->where('employee.id_mas_employee_position',1);
		$this->filter($where, $whereOR, $whereLike);

		$this->db->select('*, (SELECT COUNT(id_mas_project_status) FROM project JOIN employee_project as emp ON emp.id_project = project.id_project WHERE emp.id_employee = employee.id_employee && project.id_mas_project_status = 1) as project');
		$this->db->select('(SELECT COUNT(id_mas_project_status) FROM project JOIN employee_project as emp ON emp.id_project = project.id_project WHERE emp.id_employee = employee.id_employee && project.id_mas_project_status = 2) as close');
		$this->db->join('organization_item as org', 'org.id_organization_item = employee.id_organization_item');
		$this->db->join('mas_bp', 'mas_bp.id_mas_bp = employee.id_mas_bp');
		$this->db->join('mas_title', 'mas_title.id_mas_title = employee.id_mas_title', 'LEFT');
		$this->db->join('mas_employee_position as epos', 'epos.id_mas_employee_position = employee.id_mas_employee_position');
		$this->db->group_by('employee.id_employee');

		return $this->db->get($this->table)->result();
	}

	public function update($id = "", $data = array())
	{
		if(!empty($id)) {
			$this->db->where('md5(id_employee)', $id);
			$return = $this->db->update('employee', $data);	
		} else {
			$return = $this->db->insert('employee', $data);
		}
		
		return $return;
	}

	public function organization($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('organization_item')->result();
	}

	public function title($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('mas_title')->result();
	}

	public function position($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('mas_employee_position')->result();
	}

	public function getBP($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('mas_bp')->result();
	}

	public function competence($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('mas_competence', 'mas_competence.id_mas_competence = competence_employee.id_mas_competence');

		return $this->db->get('competence_employee')->result();
	}

	public function certificate($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('certificate', 'certificate.id_certificate = certificate_employee.id_certificate');
		$this->db->join('mas_times_category as cat', 'cat.id_mas_times_category = certificate.id_mas_times_category');

		return $this->db->get('certificate_employee')->result();
	}

	public function training($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('mas_training_type as train', 'train.id_mas_training_type = training_employee.id_training');
//		$this->db->join('mas_times_category as cat', 'cat.id_mas_times_category = training.	id_mas_times_category');
//		$this->db->join('mas_training_type as type', 'type.id_mas_training_type = training.id_mas_training_type');

		return $this->db->get('training_employee')->result();
	}

	public function education($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('employee_education')->result();
	}

	public function getCompetence()
	{
		return $this->db->get('mas_competence')->result();
	}

	public function bkoEmployee($where = array(), $whereLike = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		$this->db->join('organization_item as org', 'org.id_organization_item = bko_history.id_organization_item');
		$this->db->join('mas_title as title', 'title.id_mas_title = bko_history.id_mas_title');
		$this->db->join('mas_employee_position emp', 'emp.id_mas_employee_position = bko_history.id_mas_employee_position');

		return $this->db->get('bko_history')->{$type}();
	}

	public function workEmployee($where = array(), $whereLike = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		$this->db->join('mas_times_category as times', 'times.id_mas_times_category = work_experience.id_mas_times_category');

		return $this->db->get('work_experience')->{$type}();
	}

	public function project_bidang($result = 'result', $where = array(), $whereOR = array(), $whereLike = array())
	{
		

		return $this->getEmployee($result);
	}
}