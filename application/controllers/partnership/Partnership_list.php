<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partnership_list extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('modules/employee/employee_model');
	}
	
	function index(){
		if($_POST) {
			$this->session->set_userdata('searchUnit', $this->input->post('unit'));
			$this->session->set_userdata('searchYear', $this->input->post('year'));

			return FALSE;
		}
		$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));

		$this->template->write_view('content','themes/modules/partnership/partnership', $data);
		$this->template->render();
	}
	
	function json(){
		$data	  	= array();
		$filter 	= array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		if($this->session->userdata('searchUnit') != '') {
			$this->db->where('partnership.id_organization_item_initiator', $this->session->userdata('searchUnit'));
		}

		if($this->session->userdata('searchYear') != '') {
			$this->db->like('partnership.start_date', $this->session->userdata('searchYear'));
		}

		$this->db->join('mas_project_status', 'mas_project_status.id_mas_project_status = partnership.id_mas_project_status');
		$this->db->join('organization_item', 'organization_item.id_organization_item = partnership.id_organization_item_initiator');

		$activity = $this->db->get('partnership')->result();

		foreach($activity as $act) {
			$data[] = array(
				'id'   				=> (int) $act->id_partnership,
				'id_encrypt'   		=> md5($act->id_partnership),
				'title'				=> $act->title,
				'partner'			=> $act->partner,
				'org_name'			=> $act->org_name,
				'status'			=> $act->status,
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('searchUnit');
		$this->session->unset_userdata('searchYear');
	}
	
	
}	