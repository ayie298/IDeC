<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

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

			if(!empty($whereOR) and sizeof($whereOR) == 1) {
				$this->db->or_where($whereOR);
			}
		}

		if(!empty($whereOR) && sizeof($whereOR) > 1) {
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

		return $this->getEmployee();
	}

	public function getEmployee($type = 'result')
	{
		$this->db->join('mas_employee_position as epos', 'epos.id_mas_employee_position = employee.id_mas_employee_position');
		$this->db->join('organization_item as org', 'org.id_organization_item = employee.id_organization_item');
		$this->db->join('mas_bp', 'mas_bp.id_mas_bp = employee.id_mas_bp');
		$this->db->join('mas_title', 'mas_title.id_mas_title = employee.id_mas_title', 'LEFT');

		return $this->db->get($this->table)->{$type}();
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

	public function organization($where = array(), $type = 'result', $whereOR = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
			
			if(!empty($whereOR)) {
				$this->db->or_where($whereOR);
			}
		}

		return $this->db->get('organization_item')->{$type}();
	}

	public function title($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('title', 'ASC');

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

	public function competence($where = array(), $whereLike = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('mas_competence', 'mas_competence.id_mas_competence = competence_employee.id_mas_competence');

		return $this->db->get('competence_employee')->{$type}();
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

	public function certificateEmp($where = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('certificate', 'certificate.id_certificate = certificate_employee.id_certificate');

		return $this->db->get('certificate_employee')->{$type}();
	}

	public function training($where = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->join('training', 'training.id_training = training_employee.id_training');
		$this->db->join('mas_training_type as train', 'train.id_mas_training_type = training.id_mas_training_type');
		$this->db->join('mas_times_category as cat', 'cat.id_mas_times_category = training.	id_mas_times_category');
		$this->db->join('mas_training_type as type', 'type.id_mas_training_type = training.id_mas_training_type');

		return $this->db->get('training_employee')->{$type}();
	}

	public function education($where = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('employee_education')->{$type}();
	}

	public function getCompetence()
	{
		return $this->db->get('mas_competence')->result();
	}
}