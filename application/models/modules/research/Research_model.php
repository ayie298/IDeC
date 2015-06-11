<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Research_model extends CI_Model {

	public $table = 'performance_system';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($type = 'getResearch', $where = array())
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		return $this->{$type}('row');
	}

	public function findAll($type = 'getResearch', $where = array(), $whereOR = array(), $whereLike = array(), $limit = '', $order = array())
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

		return $this->{$type}();
	}

	public function getResearch($type = 'result')
	{	
		$this->db->select('*,research.id_research');
		$this->db->join('research_file', 'research_file.id_research = research.id_research', 'LEFT');
		$this->db->join('research_utilization', 'research_utilization.id_research = research.id_research', 'LEFT');
		$this->db->join('organization_item', 'organization_item.id_organization_item = research.id_organization_item');
		$this->db->join('mas_research_content', 'mas_research_content.id_mas_research_content = research.id_mas_research_content');
		$this->db->join('mas_research_group', 'mas_research_group.id_mas_research_group = research.id_mas_research_group');
		$this->db->join('program', 'program.id_program = research.id_program');
		$this->db->join('mas_research_type', 'mas_research_type.id_mas_research_type = research.id_mas_research_type');
		$this->db->join('mas_project_status', 'mas_project_status.id_mas_project_status = research.id_mas_project_status');

		return $this->db->get('research')->{$type}();
	}
}