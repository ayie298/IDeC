<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends CI_Model {

	public $table = 'program';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->getProgram('row');
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
				}
			}

			$this->db->where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		return $this->getProgram();
	}

	public function getProgram($type = 'result')
	{
		$this->db->join('organization_item as org', 'org.id_organization_item = program.id_organization_item');

		return $this->db->get($this->table)->{$type}();
	}

	public function getAutoIncrement($table = 'program', $field = 'id_program')
	{
		$this->db->order_by($field,' DESC');

		$num = $this->db->get($table)->row();
		$num = $num->{$field}+1;

		return $num;
	}

	public function getTarget($id_program = 0, $period = 'TW I', $type = 'result')
	{
		$this->db->join('target_item', 'target_item.id_target = program_target.id_target');
		$this->db->join('target', 'target.id_target = target_item.id_target');
		$this->db->join('mas_metric', 'mas_metric.id_mas_metric = target_item.id_mas_metric');

		$this->db->where('program_target.id_program', $id_program);
		$this->db->where('target.period', $period);

		return $this->db->get('program_target')->{$type}();
	}

	public function getReview($where = array(), $whereLike = array(), $type = 'result')
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		$this->db->join('program', 'program.id_program = review_management.id_program');
		$this->db->join('mas_review_type as type', 'type.id_mas_review_type = review_management.id_mas_review_type');

		return $this->db->get('review_management')->{$type}();
	}

	public function reviewComment($type, $where = array(), $whereLike = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($whereLike)) {
			$this->db->like($whereLike);
		}

		$this->db->join('employee', 'employee.id_user = review_comment.id_user', 'LEFT');

		return $this->db->get('review_comment')->{$type}();
	}
}