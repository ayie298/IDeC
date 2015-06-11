<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_model extends CI_Model {

	public $table = 'performance_system';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($type = 'getPerformance', $where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->{$type}('row');
	}

	public function findAll($type = 'getPerformance', $where = array(), $whereOR = array(), $whereLike = array(), $limit = '', $order = array())
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

		if(!empty($order)) {
			$this->db->order_by($order[0], $order[1]);
		}

		if(!empty($limit)) {
			$this->db->limit($limit);
		}

		return $this->{$type}();
	}

	public function getPerformance($type = 'result')
	{
		$this->db->join('organization_item as org', 'org.id_organization_item = performance_system.id_organization_item', 'LEFT');
		$this->db->join('employee as emp', 'emp.id_employee = performance_system.id_employee', 'LEFT');

		return $this->db->get($this->table)->{$type}();
	}

	public function getPerspective($type = 'result')
	{
		return $this->db->get('mas_perspective')->{$type}();
	}

	public function getIndicator($type = 'result')
	{
		return $this->db->get('performance_indicator')->{$type}();
	}

	public function getItem($type = 'result')
	{
		$this->db->join('performance_system as sys', 'sys.id_performance_system = performance_system_item.id_performance_system');
		$this->db->join('performance_indicator as ind', 'ind.id_performance_indicator = performance_system_item.id_performance_indicator', 'LEFT');

		return $this->db->get('performance_system_item')->{$type}();
	}

	public function getFormulaReal($type = 'result')
	{
		$this->db->join('mas_formula', 'mas_formula.id_mas_formula = formula_performance_indicator.id_mas_formula');

		$this->db->where('type', 'realization');

		return $this->db->get('formula_performance_indicator')->{$type}();
	}

	public function getFormulaAchieve($type = 'result')
	{
		$this->db->join('mas_formula', 'mas_formula.id_mas_formula = formula_performance_indicator.id_mas_formula');

		$this->db->where('type', 'achievement');

		return $this->db->get('formula_performance_indicator')->{$type}();
	}

	public function getQuartal($type = 'result')
	{
		return $this->db->get('performance_quartal')->{$type}();
	}

	public function getRealization($type = 'result')
	{
		return $this->db->get('performance_realization')->{$type}();
	}

	public function getTarget($type = 'result')
	{
		$this->db->select('target_item.target, target_item.id_target, target_item.target_detail');
		$this->db->join('performance_quartal as q', 'q.id_target = target_item.id_target');

		return $this->db->get('target_item')->{$type}();
	}

	public function getAllTarget($type = 'result')
	{
		$this->db->join('mas_metric', 'mas_metric.id_mas_metric = target_item.id_mas_metric');

		return $this->db->get('target_item')->{$type}();
	}

	public function getSumPeriode($id, $period = 0, $pers = 0)
	{
		$this->db->select('SUM(achievement) as total_achieve');
		$this->db->join('performance_quartal as q', 'q.id_performance_system_item = i.id_performance_system_item');
		$this->db->where('i.id_performance_system', $id);

		if($period > 0) {
			$this->db->where('q.period', $period);
		}

		if($pers > 0) {
			$this->db->where('i.id_mas_perspective', $pers);
		}

		return $this->db->get('performance_system_item as i')->row();
	}
}