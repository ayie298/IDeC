<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public $table = 'project';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($where = array(), $whereOR = array(), $whereLike = array())
	{
		$this->filter($where, $whereOR, $whereLike);

		$this->db->join('organization_item', 'organization_item.id_organization_item = project.id_organization_item');
		$this->db->join('mas_project_status as status', 'status.id_mas_project_status = project.id_mas_project_status');
		$this->db->join('mas_times_category as times', 'times.id_mas_times_category = project.id_mas_times_category');

		return $this->getProject('row');
	}

	public function findAll($where = array(), $whereOR = array(), $whereLike = array())
	{
		$this->filter($where, $whereOR, $whereLike);

		$this->db->join('organization_item', 'organization_item.id_organization_item = project.id_organization_item');
		$this->db->join('mas_project_status as status', 'status.id_mas_project_status = project.id_mas_project_status');

		return $this->getProject();
	}

	public function findStepAll($where = array(), $whereOR = array(), $whereLike = array())
	{
		$this->filter($where, $whereOR, $whereLike);

		return $this->getStep();
	}

	public function findStep($where = array(), $whereOR = array(), $whereLike = array())
	{
		$this->filter($where, $whereOR, $whereLike);

		return $this->getStep('row');
	}

	public function findMemberAll($where = array(), $whereOR = array(), $whereLike = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('project', 'project.id_project = employee_project.id_project');
		$this->db->join('employee', 'employee.id_employee = employee_project.id_employee');
		$this->db->join('mas_title', 'mas_title.id_mas_title = employee.id_mas_title', 'LEFT');
		$this->db->join('mas_employee_project_position as po', 'po.id_mas_employee_project_position = employee_project.id_mas_employee_project_position');

		return $this->db->get('employee_project')->result();
	}

	public function getProject($type = 'result')
	{
		return $this->db->get($this->table)->{$type}();
	}

	public function getStep($type = 'result')
	{
		return $this->db->get('project_step')->{$type}();
	}

	public function memberProject($id_employee = 0, $resType = 'count', $where = array(), $whereLike = array())
	{
		if($resType == 'count') {
			$this->db->select('project.*, employee_project.*, 
				count((SELECT id_project FROM project WHERE `id_mas_project_status` = 1 AND `id_project` = `employee_project`.`id_project`)) as ongoing,
				count((SELECT id_project FROM project WHERE `id_mas_project_status` = 2 AND `id_project` = `employee_project`.`id_project`)) as close, 
				');

			$this->db->group_by('employee_project.id_employee');
		}

		$this->db->join('project', 'project.id_project = employee_project.id_project');
		$this->db->where('id_employee', $id_employee);

		if($resType == 'count') {
			$result = $this->db->get('employee_project')->row();
		} else {
			$this->filter($where, array(), $whereLike);

			$result = $this->db->get('employee_project')->{$resType}();
		}

		return $result;
	}

	public function getAutoIncrement()
	{
		$this->db->order_by('id_project', 'DESC');

		$project 	= $this->getProject('row');
		$increment 	= $project->id_project+1;

		return $increment;
	}

	public function activityLog($id_project = 0, $where = array(), $res = 'result')
	{
		$this->db->join('employee_activity_log as ep', 'ep.id_employee_project = employee_project.id_employee_project');
		$this->db->join('project as pr', 'pr.id_project = employee_project.id_project');
		$this->db->join('employee as emp', 'emp.id_employee = employee_project.id_employee');
		$this->db->join('project_step as step', 'step.id_project_step = ep.id_project_step');
		$this->db->join('mas_project_status as stat', 'stat.id_mas_project_status = ep.id_mas_project_status');
		$this->db->join('mas_employee_project_position as empp', 'empp.id_mas_employee_project_position = employee_project.id_mas_employee_project_position');

		if($id_project != 0) {
			$this->db->where('employee_project.id_project', $id_project);
		}

		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('employee_project')->{$res}();
	}

	private function filter($where = array(), $whereOR = array(), $whereLike = array())
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
				}
			}

			$this->db->where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		return $this->db;
	}
}